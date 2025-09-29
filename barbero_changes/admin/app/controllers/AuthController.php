<?php
session_start();
require_once __DIR__ . '/../models/Admin.php';


class AuthController
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                return ['success' => false, 'message' => 'El usuario y contraseña no pueden ser vacíos'];
            }
            // Autentificación
            $admin = $this->adminModel->authenticate($username, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_nombre'] = $admin['nombre'];
                $_SESSION['admin_email'] = $admin['email'];

                return ['success' => true, 'redirect' => 'dashboard.php'];
            } else {
                return ['success' => false, 'message' => 'credenciales invalidas'];
            }
        }
        return ['success' => false, 'message' => 'Método no permitido'];
    }
    public function logout()
    {
        session_destroy();
        return ['success' => true, 'redirect' => 'login.php'];
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['admin_id']);
    }

    public function requireAuth()
    {
        if (!$this->isAuthenticated()) {
            header('Location: login.php');
        }
    }

    public function getCurrentAdmin()
    {
        if ($this->isAuthenticated()) {
            return [
                'id' => $_SESSION['admin_id'],
                'username' => $_SESSION['admin_username'],
                'nombre' => $_SESSION['admin_nombre'],
                'email' => $_SESSION['admin_email']
            ];
        }
        return null;
    }
}
