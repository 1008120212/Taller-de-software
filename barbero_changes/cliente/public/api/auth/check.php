<?php
require_once '../../app/config/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (isset($_SESSION['cliente_logged_in']) && $_SESSION['cliente_logged_in'] === true) {
    echo json_encode([
        'success' => true,
        'cliente' => [
            'id' => $_SESSION['cliente_id'],
            'nombre' => $_SESSION['cliente_nombre'],
            'email' => $_SESSION['cliente_email']
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autenticado'
    ]);
}