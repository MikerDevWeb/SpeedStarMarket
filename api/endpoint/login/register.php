<?php
require_once __DIR__ . '/../../core/conection.php';
require_once __DIR__ . '/../../core/funtions.php';
require_once __DIR__ . '/../../core/jwt-funtions/jwt_utils.php';
setHeaders();

$data = json_decode(file_get_contents('php://input'), true);

$username = sanitizeString($data['user']);
$password = $data['password'];

if(empty($username) || empty($password)) {
    echo simpleJson(false, 'Información invalida');
    exit;
}

if(strlen($password) < 8) {
    echo simpleJson(false, 'La contraseña debe ser de al menos 8 dígitos');
    exit;
}

//find user
$findUser = $conn->prepare('SELECT user_id FROM users WHERE user_name = ?');
$findUser->bind_param('s', $username);
$findUser->execute();

$userData = $findUser->get_result();

if($userData->num_rows > 0) {
    echo simpleJson(false, 'El nombre de usuario ya está en uso');
    exit;
}

$findUser->close();

//create data
$userId = createUserId();
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$registerAt = getCurrentDateTime();

//save user
$createUser = $conn->prepare('INSERT INTO users (user_id, user_name, user_password, created_at) VALUES (?, ?, ?, ?)');
$createUser->bind_param('ssss', 
    $userId,
    $username,
    $passwordHash,
    $registerAt
);

if($createUser->execute()) {
    $newToken = createToken($userId);
    echo json_encode([
        'success' => true,
        'auth' => $newToken
    ]);
} else {
    echo simpleJson(false, 'Error al crear tu cuenta');
}


