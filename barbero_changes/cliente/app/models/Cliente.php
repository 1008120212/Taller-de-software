<?php
class Cliente
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerCliente($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crearCliente($datos)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO clientes (nombre, email, telefono, fecha_registro) 
                VALUES (?, ?, ?, NOW())
            ");
            $result = $stmt->execute([
                $datos['nombre'],
                $datos['email'],
                $datos['telefono']
            ]);

            if ($result) {
                return $this->db->lastInsertId();
            }
            return false;
        } catch (Exception $e) {
            throw new Exception("Error al crear cliente: " . $e->getMessage());
        }
    }

    public function actualizarCliente($id, $datos)
    {
        $stmt = $this->db->prepare("
            UPDATE clientes 
            SET nombre = ?, email = ?, telefono = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $datos['nombre'],
            $datos['email'],
            $datos['telefono'],
            $id
        ]);
    }

    public function buscarClientePorEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function buscarClientePorEmailYNombre($email, $nombre)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE email = ? AND nombre = ?");
        $stmt->execute([$email, $nombre]);
        return $stmt->fetch();
    }

    public function verificarClienteExistente($email, $nombre, $telefono)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM clientes 
            WHERE email = ? AND nombre = ? AND telefono = ?
        ");
        $stmt->execute([$email, $nombre, $telefono]);
        return $stmt->fetch();
    }
}