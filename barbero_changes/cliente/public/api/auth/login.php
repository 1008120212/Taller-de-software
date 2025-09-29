<?php
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => "Error PHP: $errstr en $errfile línea $errline"
    ]);
    exit;
});
require_once '../../../app/config/config.php';
// session_start(); // Eliminada porque ya se inicia en config.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir configuración
require_once '../../../app/config/database.php';

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    // Obtener datos del formulario
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar datos
    if (empty($email) || empty($password)) {
        throw new Exception('Todos los campos son requeridos');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('El formato del email no es válido');
    }

    // Conectar a la base de datos
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscar cliente por email
    $stmt = $pdo->prepare("SELECT id, nombre, email, telefono, password FROM clientes WHERE email = ?");
    $stmt->execute([$email]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        throw new Exception('Email o contraseña incorrectos');
    }

    // Verificar si el cliente tiene contraseña
    if (empty($cliente['password'])) {
        throw new Exception('Este email no tiene contraseña registrada. Por favor regístrate primero.');
    }

    // Verificar contraseña
    if (!password_verify($password, $cliente['password'])) {
        throw new Exception('Email o contraseña incorrectos');
    }

    // Iniciar sesión
    $_SESSION['cliente_id'] = $cliente['id'];
    $_SESSION['cliente_nombre'] = $cliente['nombre'];
    $_SESSION['cliente_email'] = $cliente['email'];
    $_SESSION['cliente_telefono'] = $cliente['telefono'];
    $_SESSION['cliente_logged_in'] = true;

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Inicio de sesión exitoso',
        'cliente' => [
            'id' => $cliente['id'],
            'nombre' => $cliente['nombre'],
            'email' => $cliente['email'],
            'telefono' => $cliente['telefono']
        ]
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>