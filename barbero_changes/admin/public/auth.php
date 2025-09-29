<?php
require_once __DIR__ . '/../app/controllers/AuthController.php';

$authController = new AuthController();

// Manejar acciones
$action = $_GET['action'] ?? '';

if ($action === 'logout') {
    $result = $authController->logout();
    header('Location: ' . $result['redirect']);
    exit;
}

// Manejar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $authController->login();

    // Si es una petición AJAX, devolver JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    // Si es una petición normal, redirigir
    if ($result['success']) {
        header('Location: ' . $result['redirect']);
    } else {
        header('Location: login.php?error=' . urlencode($result['message']));
    }
    exit;
}

// Si no hay acción específica, redirigir al login
header('Location: login.php');
exit;
