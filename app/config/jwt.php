<?php

/**
 * Generate your own secret key by running this from the terminal:
 * 		php -r "echo base64_encode(openssl_random_pseudo_bytes(64)) . PHP_EOL;"
 * Then copy/paste it below
 */

// Secret JWT key
$app->jwt_key = 'insert key here';