<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('PNFPB_ai_notification_provider_contract')) {
    interface PNFPB_ai_notification_provider_contract
    {
        public function pnfpb_get_provider_name();

        public function pnfpb_supports_feature($feature);

        public function pnfpb_prepare_request(array $context);

        public function pnfpb_request(array $request);

        public function pnfpb_parse_response($response);

        public function pnfpb_get_request_schema();

        public function pnfpb_get_response_schema();
    }
}

if (!class_exists('PNFPB_default_ai_notification_provider_class')) {
    class PNFPB_default_ai_notification_provider_class implements PNFPB_ai_notification_provider_contract
    {
        public function pnfpb_get_provider_name()
        {
            return 'default-http-json';
        }

        public function pnfpb_supports_feature($feature)
        {
            return in_array($feature, ['draft', 'on_demand', 'post'], true);
        }

        public function pnfpb_get_request_schema()
        {
            return [
                'feature' => 'string',
                'title' => 'string',
                'content' => 'string',
                'post_type' => 'string',
                'audience' => 'string',
                'sender_name' => 'string',
                'click_url' => 'string',
                'language' => 'string',
                'tone' => 'string',
                'source' => 'string',
            ];
        }

        public function pnfpb_get_response_schema()
        {
            return [
                'title' => 'string',
                'content' => 'string',
                'send_time' => 'string',
                'audience_hint' => 'string',
                'confidence' => 'number',
                'source' => 'provider|fallback',
                'provider_name' => 'string',
                'provider_error' => 'string',
            ];
        }

        public function pnfpb_prepare_request(array $context)
        {
            $endpoint = esc_url_raw(get_option('pnfpb_ai_assistant_endpoint'));
            $api_key = (string) get_option('pnfpb_ai_assistant_api_key');
            $model = (string) get_option('pnfpb_ai_assistant_model');

            if ($endpoint === '') {
                return new WP_Error('pnfpb_ai_no_provider', __('No AI provider endpoint is configured.', 'push-notification-for-post-and-buddypress'));
            }

            return [
                'endpoint' => $endpoint,
                'headers' => array_filter([
                    'Content-Type' => 'application/json',
                    'Authorization' => $api_key !== '' ? 'Bearer ' . $api_key : '',
                ]),
                'body' => [
                    'model' => $model !== '' ? $model : 'gpt-4.1-mini',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You generate concise push notification drafts. Return JSON with keys title, content, send_time, audience_hint, and confidence.',
                        ],
                        [
                            'role' => 'user',
                            'content' => wp_json_encode($context),
                        ],
                    ],
                    'temperature' => 0.4,
                    'response_format' => ['type' => 'json_object'],
                ],
            ];
        }

        public function pnfpb_request(array $request)
        {
            if (!isset($request['endpoint']) || $request['endpoint'] === '') {
                return new WP_Error('pnfpb_ai_no_provider', __('No AI provider endpoint is configured.', 'push-notification-for-post-and-buddypress'));
            }

            $response = wp_remote_post(
                $request['endpoint'],
                [
                    'timeout' => 20,
                    'headers' => isset($request['headers']) && is_array($request['headers']) ? $request['headers'] : [],
                    'body' => wp_json_encode(isset($request['body']) && is_array($request['body']) ? $request['body'] : []),
                ]
            );

            if (is_wp_error($response)) {
                return $response;
            }

            $body = wp_remote_retrieve_body($response);
            if ($body === '') {
                return new WP_Error('pnfpb_ai_empty_response', __('AI provider returned an empty response.', 'push-notification-for-post-and-buddypress'));
            }

            return $body;
        }

        public function pnfpb_parse_response($response)
        {
            if (is_wp_error($response)) {
                return $response;
            }

            $decoded = json_decode((string) $response, true);
            if (!is_array($decoded)) {
                return new WP_Error('pnfpb_ai_invalid_response', __('AI provider returned invalid JSON.', 'push-notification-for-post-and-buddypress'));
            }

            $content = '';

            if (isset($decoded['content']) && is_string($decoded['content'])) {
                $content = $decoded['content'];
            } elseif (isset($decoded['choices'][0]['message']['content'])) {
                $content = (string) $decoded['choices'][0]['message']['content'];
            } elseif (isset($decoded['choices'][0]['text'])) {
                $content = (string) $decoded['choices'][0]['text'];
            } elseif (isset($decoded['data'][0]['content'])) {
                $content = (string) $decoded['data'][0]['content'];
            }

            if ($content === '') {
                return new WP_Error('pnfpb_ai_missing_content', __('AI provider response did not include draft content.', 'push-notification-for-post-and-buddypress'));
            }

            $parsed = json_decode($content, true);
            if (!is_array($parsed)) {
                $parsed = [
                    'content' => $content,
                ];
            }

            $title = isset($parsed['title']) ? sanitize_text_field($parsed['title']) : '';
            $draft_content = isset($parsed['content']) ? sanitize_text_field($parsed['content']) : '';
            $send_time = isset($parsed['send_time']) ? sanitize_text_field($parsed['send_time']) : '';
            $audience_hint = isset($parsed['audience_hint']) ? sanitize_text_field($parsed['audience_hint']) : '';
            $confidence = isset($parsed['confidence']) ? floatval($parsed['confidence']) : 0.75;

            if ($title === '' && $draft_content === '') {
                return new WP_Error('pnfpb_ai_invalid_draft', __('AI provider response did not contain usable draft fields.', 'push-notification-for-post-and-buddypress'));
            }

            return [
                'title' => $title,
                'content' => $draft_content,
                'send_time' => $send_time,
                'audience_hint' => $audience_hint,
                'confidence' => $confidence,
                'source' => 'provider',
                'provider_name' => $this->pnfpb_get_provider_name(),
                'provider_error' => '',
            ];
        }
    }
}

if (!class_exists('PNFPB_ai_notification_assistant_class')) {
    class PNFPB_ai_notification_assistant_class
    {
        private $provider;

        public function __construct(?PNFPB_ai_notification_provider_contract $provider = null)
        {
            $this->provider = $provider ? $provider : new PNFPB_default_ai_notification_provider_class();
        }

        public function pnfpb_is_enabled($feature = 'draft')
        {
            if (get_option('pnfpb_ai_assistant_enable') !== '1') {
                return false;
            }

            if ($feature === 'on_demand') {
                return get_option('pnfpb_ai_assistant_enable_on_demand') === '1';
            }

            if ($feature === 'post') {
                return get_option('pnfpb_ai_assistant_enable_post_editor') === '1';
            }

            return true;
        }

        public function pnfpb_is_configured()
        {
            $endpoint = trim((string) get_option('pnfpb_ai_assistant_endpoint'));
            $api_key = trim((string) get_option('pnfpb_ai_assistant_api_key'));

            return $endpoint !== '' && $api_key !== '';
        }

        public function pnfpb_build_preview(array $context)
        {
            $feature = isset($context['feature']) ? sanitize_key($context['feature']) : 'draft';

            if (!$this->pnfpb_is_configured()) {
                return new WP_Error(
                    'pnfpb_ai_missing_configuration',
                    __('AI assistant requires configuration in the AI assistant tab. Add the endpoint and credentials first.', 'push-notification-for-post-and-buddypress')
                );
            }

            if (!$this->pnfpb_is_enabled($feature)) {
                return new WP_Error(
                    'pnfpb_ai_disabled',
                    __('AI assistant is disabled for this workflow.', 'push-notification-for-post-and-buddypress')
                );
            }

            $normalized_context = $this->pnfpb_normalize_context($context);

            if (!$this->provider->pnfpb_supports_feature($feature)) {
                return $this->pnfpb_build_fallback_preview($normalized_context, new WP_Error('pnfpb_ai_unsupported_feature', __('AI provider does not support this workflow.', 'push-notification-for-post-and-buddypress')));
            }

            $request = $this->provider->pnfpb_prepare_request($normalized_context);
            if (is_wp_error($request)) {
                return $this->pnfpb_build_fallback_preview($normalized_context, $request);
            }

            $provider_response = $this->provider->pnfpb_request($request);
            if (is_wp_error($provider_response)) {
                return $this->pnfpb_build_fallback_preview($normalized_context, $provider_response);
            }

            $parsed_response = $this->provider->pnfpb_parse_response($provider_response);
            if (!is_wp_error($parsed_response) && is_array($parsed_response)) {
                $parsed_response['request_schema'] = $this->provider->pnfpb_get_request_schema();
                $parsed_response['response_schema'] = $this->provider->pnfpb_get_response_schema();
                return $parsed_response;
            }

            return $this->pnfpb_build_fallback_preview($normalized_context, $parsed_response);
        }

        private function pnfpb_normalize_context(array $context)
        {
            $title = isset($context['title']) ? sanitize_text_field(wp_unslash($context['title'])) : '';
            $content = isset($context['content']) ? wp_kses_post(wp_unslash($context['content'])) : '';
            $post_type = isset($context['post_type']) ? sanitize_text_field(wp_unslash($context['post_type'])) : 'post';
            $audience = isset($context['audience']) ? sanitize_text_field(wp_unslash($context['audience'])) : 'broad';
            $sender_name = isset($context['sender_name']) ? sanitize_text_field(wp_unslash($context['sender_name'])) : '';
            $click_url = isset($context['click_url']) ? esc_url_raw(wp_unslash($context['click_url'])) : '';
            $source = isset($context['source']) ? sanitize_text_field(wp_unslash($context['source'])) : 'manual';

            $summary = wp_strip_all_tags($content);
            $summary = preg_replace('/\s+/', ' ', $summary);
            $summary = trim((string) $summary);

            $share_full_content = get_option('pnfpb_ai_assistant_share_full_content') === '1';
            if (!$share_full_content) {
                $summary = wp_trim_words($summary, 120, '');
            }

            $max_input_chars = (int) get_option('pnfpb_ai_assistant_max_input_chars');
            if ($max_input_chars <= 0) {
                $max_input_chars = 2400;
            }

            if (!$share_full_content && $max_input_chars > 1200) {
                $max_input_chars = 1200;
            }

            if (strlen($summary) > $max_input_chars) {
                $summary = substr($summary, 0, $max_input_chars);
            }

            return [
                'feature' => isset($context['feature']) ? sanitize_key($context['feature']) : 'draft',
                'title' => $title,
                'content' => $summary,
                'post_type' => $post_type,
                'audience' => $audience,
                'sender_name' => $sender_name,
                'click_url' => $click_url,
                'source' => $source,
                'language' => isset($context['language']) ? sanitize_text_field(wp_unslash($context['language'])) : get_locale(),
                'tone' => isset($context['tone']) ? sanitize_text_field(wp_unslash($context['tone'])) : 'clear',
            ];
        }

        private function pnfpb_build_fallback_preview(array $context, $provider_error = null)
        {
            $content = isset($context['content']) ? $context['content'] : '';
            $title = isset($context['title']) ? $context['title'] : '';

            if ($title === '') {
                /* translators: %s is the post type label used in the fallback AI preview title. */
                $title = isset($context['post_type']) ? sprintf(__('New %s update', 'push-notification-for-post-and-buddypress'), $context['post_type']) : __('New update', 'push-notification-for-post-and-buddypress');
            }

            $summary = wp_trim_words($content, 22, '');
            if ($summary === '') {
                $summary = __('Read the latest update in the app or website.', 'push-notification-for-post-and-buddypress');
            }

            $send_at = gmdate('Y-m-d H:i:s', strtotime('+90 minutes'));
            if (strlen($content) > 800) {
                $send_at = gmdate('Y-m-d H:i:s', strtotime('+3 hours'));
            }

            return [
                'title' => wp_strip_all_tags($title),
                'content' => wp_strip_all_tags($summary),
                'send_time' => $send_at,
                'audience_hint' => isset($context['audience']) ? $context['audience'] : 'broad',
                'confidence' => 0.45,
                'source' => 'fallback',
                'provider_name' => $this->provider->pnfpb_get_provider_name(),
                'provider_error' => is_wp_error($provider_error) ? $provider_error->get_error_message() : '',
                'request_schema' => $this->provider->pnfpb_get_request_schema(),
                'response_schema' => $this->provider->pnfpb_get_response_schema(),
            ];
        }
    }
}