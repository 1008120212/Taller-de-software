<?php
class ClienteController
{
    private $clienteModel;
    private $reservaModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        // Obtener datos necesarios para la vista
        $bannerImages = $this->obtenerBannerImages();

        // Cargar la vista
        require_once VIEWS_PATH . '/cliente/index.php';
    }
    private function gestionarCliente($datos)
    {
        // Si el usuario está logueado y se envía cliente_id, usarlo directamente
        if (isset($datos['cliente_id']) && is_numeric($datos['cliente_id'])) {
            return (int) $datos['cliente_id'];
        }
        try {
            // Primero verificar si existe un cliente exacto (email, nombre y teléfono)
            $clienteExacto = $this->clienteModel->verificarClienteExistente(
                $datos['email'],
                $datos['name'],
                $datos['phone']
            );
            if ($clienteExacto) {
                // Cliente exacto encontrado, usar este
                return $clienteExacto['id'];
            }
            // Verificar si existe cliente con el mismo email pero datos diferentes
            $clientePorEmail = $this->clienteModel->buscarClientePorEmail($datos['email']);
            if ($clientePorEmail) {
                // Si el nombre o teléfono son diferentes, crear un nuevo cliente
                if (
                    $clientePorEmail['nombre'] !== $datos['name'] ||
                    $clientePorEmail['telefono'] !== $datos['phone']
                ) {
                    // Crear nuevo cliente con datos actualizados
                    $nuevoClienteId = $this->clienteModel->crearCliente([
                        'nombre' => $datos['name'],
                        'email' => $datos['email'],
                        'telefono' => $datos['phone']
                    ]);
                    if (!$nuevoClienteId) {
                        throw new Exception("Error al crear nuevo cliente");
                    }
                    return $nuevoClienteId;
                } else {
                    // Datos iguales, usar cliente existente
                    return $clientePorEmail['id'];
                }
            } else {
                // No existe cliente con este email, crear nuevo
                $nuevoClienteId = $this->clienteModel->crearCliente([
                    'nombre' => $datos['name'],
                    'email' => $datos['email'],
                    'telefono' => $datos['phone']
                ]);
                if (!$nuevoClienteId) {
                    throw new Exception("Error al crear cliente");
                }
                return $nuevoClienteId;
            }
        } catch (Exception $e) {
            throw new Exception("Error en gestión de cliente: " . $e->getMessage());
        }
    }
    private function obtenerBannerImages()
    {
        return [
            "https://images.unsplash.com/photo-1592647420148-bfcc177e2117?q=80&w=2039&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=2070&auto=format&fit=crop",
            "https://plus.unsplash.com/premium_photo-1677444546743-df9417435451?q=80&w=2071&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1496181832051-69dcf27fc27d?q=80&w=1931&auto=format&fit=crop"
        ];
    }
}