<?php

$encryption_key = get_option("PNFPB_icfcm_integrate_app_secret_code");

$encrypted = sanitize_text_field($request["token"]);

$parts = explode(":", $encrypted);

$keynonce = $encryption_key;

// Decode AES-256-CBC/AES-256-GCM encrypted data from mobile app to extract and store subscription token in WordPress database


$decrypted_cbc = openssl_decrypt(
    base64_decode($parts[0]),
    "aes-256-cbc",
    $keynonce,
    OPENSSL_RAW_DATA,
    base64_decode($parts[1])
);

$tagLength = 16;

$tag = substr(base64_decode($parts[0]), -16);

$ciphertext = substr(base64_decode($parts[0]), 0, -16);

$decrypted_gcm = openssl_decrypt(
    $ciphertext,
    "aes-256-gcm",
    $keynonce,
    OPENSSL_RAW_DATA,
    base64_decode($parts[1]),
    $tag
);

if (!$decrypted_gcm && !$decrypted_cbc) {

	return new WP_Error('rest_forbidden', 'Missing or invalid encryption/authorization token', array('status' => 401));
	
} else {
    if (!$decrypted_cbc) {
        $decrypted = $decrypted_gcm;
    } else {
        $decrypted = $decrypted_cbc;
    }

    $key = hash("sha256", $encryption_key);

    $receivedhasmac = base64_decode($parts[2]);

    $bphasmac = hash_hmac("sha256", $decrypted, $encryption_key);

    if ($bphasmac !== $parts[3]) {

		return new WP_Error('rest_forbidden', 'Missing or invalid hash/authorization token', array('status' => 401));
    }
	
	return true;
	
}


?>