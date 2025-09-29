<?php
require_once __DIR__ . '/../config/database.php';

class Admin
{
    private $conn;
    private $table_name = 'administradores';
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function authenticate($username, $password)
    {
        $query = 'SELECT id, username, nombre, email, password FROM ' . $this->table_name . " WHERE username = :username AND activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $admin = $stmt->fetch();
        if ($admin) {
            // si la contra es hash, usamos password_verify
            if (strlen($admin['password']) > 20) {
                if (password_verify($password, $admin['password'])) {
                    unset($admin['password']);
                    return $admin;
                }
            } else {
                // Compatibilidad con contraseñas antiguas en texto plano
                if ($admin['password'] === $password) {
                    unset($admin['password']);
                    return $admin;
                }
            }
        }
        return false;
    }
    public function getById($id)
    {
        $query = 'SELECT id, username, nombre, email FROM' . $this->table_name . 'WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
}