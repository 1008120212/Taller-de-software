<?php
// Configuración de la aplicación
define('APP_NAME', 'BARBERÍA MENSPIRE ');
define('APP_URL', 'http://localhost/barbero_changes/cliente');
define('APP_VERSION', '2.0.0');
define('APP_DEBUG', true); // Cambiar a false en producción

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'barbero');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de rutas
define('ROOT_PATH', dirname(__DIR__, 2));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('VIEWS_PATH', APP_PATH . '/views');
define('CONTROLLERS_PATH', APP_PATH . '/controllers');
define('MODELS_PATH', APP_PATH . '/models');

// Configuración de sesión
define('SESSION_NAME', 'barbero_session');
define('SESSION_LIFETIME', 7200); // 2 horas

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Configuración de errores
ini_set('display_errors', 1); // Enable error display for debugging
ini_set('display_startup_errors', 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

// Configuración de sesión
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => SESSION_LIFETIME,
        'path' => '/barbero/cliente',
        'domain' => '',
        'secure' => true, // Set to true for HTTPS
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}
session_start();
// Forzar actualización de la cookie de sesión en cada request
setcookie(session_name(), session_id(), [
    'expires' => time() + SESSION_LIFETIME,
    'path' => '/barbero/cliente', // Cambia a '/' si quieres que sea global
    'domain' => '',
    'secure' => true, // Set to true for HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);

// Función de autoload para cargar clases automáticamente
spl_autoload_register(function ($class) {
    $paths = [
        CONTROLLERS_PATH . '/',
        MODELS_PATH . '/',
        APP_PATH . '/config/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});