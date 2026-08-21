<?php
date_default_timezone_set('America/Mexico_City');
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

//sanitize texts
function sanitizeString($input): string {
    if (!is_string($input)) {
        return $input;
    }

    $value = trim($input);

    $value = strip_tags($value);

    
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

    $value = preg_replace('/\s+/', ' ', $value);

    return $value;
}

//create user id
function createUserId(): string {
    global $conn;
    do {
        $newId = random_int(1000000000, 9999999999);
        $findNumber = $conn->prepare('SELECT user_id FROM users WHERE user_id = ?');
        $findNumber->bind_param('s', $newId);
        $findNumber->execute();
        $findNumber->store_result();
        $exist = $findNumber->num_rows > 0;
        $findNumber->close();
    } while ($exist);

    return $newId;
}

//getDate
function getCurrentDateTime() {
    return date('Y-m-d H:i:s');
}