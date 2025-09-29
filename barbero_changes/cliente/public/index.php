<?php
// autoloader
require_once dirname(__DIR__) . '/app/config/config.php';
require_once ROOT_PATH . '/app/config/database.php';

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';

    switch ($controller) {
        case 'cliente':
            require ROOT_PATH . '/app/controllers/ClienteController.php';
            $clienteController = new ClienteController();

            switch ($action) {
                case 'index':
                    $clienteController->index();
                    break;
                case 'reservar':
                    $clienteController->reservar();
                    break;
                default:
                    $clienteController->index();
                    break;
            }
            break;

        default:
            require ROOT_PATH . '/app/controllers/ClienteController.php';
            $clienteController = new ClienteController();
            $clienteController->index();
            break;
    }
} else {
    // Página principal por defecto
    require ROOT_PATH . '/app/controllers/ClienteController.php';
    $controller = new ClienteController();
    $controller->index();
}