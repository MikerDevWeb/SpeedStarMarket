<?php
require_once __DIR__ . '/../../core/conection.php';
require_once __DIR__ . '/../../core/funtions.php';
require_once __DIR__ . '/../../core/jwt-funtions/jwt_utils.php';
setHeaders();

$data = json_decode(file_get_contents('php://input'), true);

$username = sanitizeString($data['user']);
$password = $data['password'];

if(empty($username) || empty($password)) {
    echo simpleJson(false, 'Usuario o contraseña incorrectos');
    exit;
}

//find user
$find = $conn->prepare('SELECT user_id, user_password FROM users WHERE user_name = ? LIMIT 1');
$find->bind_param('s', $username);
$find->execute();

$user = $find->get_result();

if($user->num_rows < 1) {
    echo simpleJson(false, 'Usuario no registrado');
    exit;
}

$user = $user->fetch_assoc();

if(!password_verify($password, $user['user_password'])) {
    echo simpleJson(false, 'Contraseña incorrecta');
    exit;
}

$find->close();

//generate token

$newToken = createToken($user['user_id']);

echo json_encode([
    'success' => true,
    'auth' => $newToken
]);

