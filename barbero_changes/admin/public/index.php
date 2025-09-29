<?php
require_once __DIR__ . '/../app/controllers/AuthController.php';
$authController = new AuthController();
$authController->requireAuth();

$admin = $authController->getCurrentAdmin();
$pageTitle = 'Panel de Administración';
$reservasCount = 0; // Se calculará dinámicamente
