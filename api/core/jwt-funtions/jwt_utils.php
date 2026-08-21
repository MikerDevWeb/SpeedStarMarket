<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/jwt_config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function createToken(string $userId) {
    $payload = [
        'sub' => $userId,
        'iat' => time(),
        'exp' => time() + JWT_EXPIRATION
    ];

    return JWT::encode($payload, JWT_SECRET, JWT_ALGO);
}

function decodeToken(string $token) {
    try {
        return JWT::decode($token, new Key(JWT_SECRET, JWT_ALGO));
    } catch (Exception $e) {
        return false;
    }
}