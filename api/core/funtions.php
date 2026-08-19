<?php
//headers
function setHeaders() {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *'); // Permitir solicitudes desde cualquier origen
    header('Access-Control-Allow-Methods: GET, POST'); // Métodos permitidos
    header('Access-Control-Allow-Headers: Content-Type'); // Encabezados permitidos
}

//generate JSON response
function simpleJson(bool $success, string $message) {
    return json_encode([
        'success' => $success,
        'message' => $message
    ]);
}

function objectJson(bool $success, array $object) {
    return json_encode([
        'success' => $success,
        'response' => $object
    ]);
}