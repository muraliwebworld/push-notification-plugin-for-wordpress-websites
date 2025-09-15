<?php

/**
 * Class ActionScheduler_wpPostStore_PostTypeRegistrar
 *
 * @codeCoverageIgnore
 */
class ActionScheduler_wpPostStore_PostTypeRegistrar {
	/**
	 * Registrar.
	 */
	public function register() {
		register_post_type( ActionScheduler_wpPostStore::POST_TYPE, $this->post_type_args() );
	}

	/**
	 * Build the args array for the post type definition
	 *
	 * @return array
	 */
	protected function post_type_args() {
		$args = array(
			'label'        => __( 'Scheduled Actions', 'push-notification-for-post-and-buddypress' ),
			'description'  => __( 'Scheduled actions are hooks triggered on a certain date and time.', 'push-notification-for-post-and-buddypress' ),
			'public'       => false,
			'map_meta_cap' => true,
			'hierarchical' => false,
			'supports'     => array( 'title', 'editor', 'comments' ),
			'rewrite'      => false,
			'query_var'    => false,
			'can_export'   => true,
			'ep_mask'      => EP_NONE,
			'labels'       => array(
				'name'               => __( 'Scheduled Actions', 'push-notification-for-post-and-buddypress' ),
				'singular_name'      => __( 'Scheduled Action', 'push-notification-for-post-and-buddypress' ),
				'menu_name'          => _x( 'Scheduled Actions', 'Admin menu name', 'push-notification-for-post-and-buddypress' ),
				'add_new'            => __( 'Add', 'push-notification-for-post-and-buddypress' ),
				'add_new_item'       => __( 'Add New Scheduled Action', 'push-notification-for-post-and-buddypress' ),
				'edit'               => __( 'Edit', 'push-notification-for-post-and-buddypress' ),
				'edit_item'          => __( 'Edit Scheduled Action', 'push-notification-for-post-and-buddypress' ),
				'new_item'           => __( 'New Scheduled Action', 'push-notification-for-post-and-buddypress' ),
				'view'               => __( 'View Action', 'push-notification-for-post-and-buddypress' ),
				'view_item'          => __( 'View Action', 'push-notification-for-post-and-buddypress' ),
				'search_items'       => __( 'Search Scheduled Actions', 'push-notification-for-post-and-buddypress' ),
				'not_found'          => __( 'No actions found', 'push-notification-for-post-and-buddypress' ),
				'not_found_in_trash' => __( 'No actions found in trash', 'push-notification-for-post-and-buddypress' ),
			),
		);

		$args = apply_filters( 'action_scheduler_post_type_args', $args );
		return $args;
	}
}
