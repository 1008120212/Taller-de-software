<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#111827",
                        secondary: "#d97706",
                        accent: "#1f2937"
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-4">
                <i class="fas fa-cut text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">BARBERÍA MENSPIRE</h1>
            <p class="text-gray-600">Panel de Administración</p>
        </div>

        <!-- Formulario de Login -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión</h2>

            <form id="loginForm" method="POST" action="auth.php">
                <div class="mb-6">
                    <label for="username" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-user mr-2"></i>Usuario
                    </label>
                    <input type="text" id="username" name="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                        placeholder="Ingresa tu usuario" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2"></i>Contraseña
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                        placeholder="Ingresa tu contraseña" required>
                </div>

                <button type="submit"
                    class="w-full bg-secondary hover:bg-amber-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Iniciar Sesión
                </button>
            </form>


        </div>


    </div>
    </div>

    <script>
        // Manejo del formulario
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Mostrar loading
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Iniciando sesión...';
            submitBtn.disabled = true;

            fetch('auth.php', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirección inmediata sin SweetAlert
                        window.location.href = data.redirect;
                    } else {
                        // Mostrar error con alerta simple
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error de conexión. Intenta nuevamente.');
                })
                .finally(() => {
                    // Restaurar botón
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });

        // Mostrar mensaje de error si existe
        <?php if (isset($_GET['error'])): ?>
            // Swal.fire({
            //     icon: 'error',
            //     title: 'Error',
            //     text: '<?php echo htmlspecialchars($_GET['error']); ?>'
            // });
        <?php endif; ?>
    </script>
</body>

</html>