<?php
require_once '../../../app/config/config.php';

// Incluir configuración
require_once '../../../app/config/database.php';

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    // Obtener datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validar datos
    if (empty($nombre) || empty($email) || empty($telefono) || empty($password)) {
        throw new Exception('Todos los campos son requeridos');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('El formato del email no es válido');
    }

    if (strlen($password) < 6) {
        throw new Exception('La contraseña debe tener al menos 6 caracteres');
    }

    if (strlen($nombre) < 2) {
        throw new Exception('El nombre debe tener al menos 2 caracteres');
    }

    // Conectar a la base de datos
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM clientes WHERE email = ?");
    $stmt->execute([$email]);
    $clienteExistente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($clienteExistente) {
        // Si el cliente existe pero no tiene contraseña, actualizar
        $stmt = $pdo->prepare("SELECT password FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($cliente['password'])) {
            throw new Exception('Este email ya está registrado');
        } else {
            // Actualizar cliente existente con contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE clientes SET nombre = ?, telefono = ?, password = ? WHERE email = ?");
            $stmt->execute([$nombre, $telefono, $passwordHash, $email]);

            // Obtener el ID del cliente actualizado
            $stmt = $pdo->prepare("SELECT id FROM clientes WHERE email = ?");
            $stmt->execute([$email]);
            $clienteActualizado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Iniciar sesión automáticamente
            $_SESSION['cliente_id'] = $clienteActualizado['id'];
            $_SESSION['cliente_nombre'] = $nombre;
            $_SESSION['cliente_email'] = $email;
            $_SESSION['cliente_logged_in'] = true;

            echo json_encode([
                'success' => true,
                'message' => 'Cuenta actualizada exitosamente',
                'cliente' => [
                    'id' => $clienteActualizado['id'],
                    'nombre' => $nombre,
                    'email' => $email
                ]
            ]);
            exit;
        }
    }

    // Crear nuevo cliente
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO clientes (nombre, email, telefono, password, fecha_registro) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$nombre, $email, $telefono, $passwordHash]);

    $clienteId = $pdo->lastInsertId();

    // Iniciar sesión automáticamente
    $_SESSION['cliente_id'] = $clienteId;
    $_SESSION['cliente_nombre'] = $nombre;
    $_SESSION['cliente_email'] = $email;
    $_SESSION['cliente_logged_in'] = true;

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Cuenta creada exitosamente',
        'cliente' => [
            'id' => $clienteId,
            'nombre' => $nombre,
            'email' => $email
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