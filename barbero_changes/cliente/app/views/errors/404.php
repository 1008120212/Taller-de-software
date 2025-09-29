<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada - <?= APP_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto text-center">
        <div class="mb-8">
            <i class="fas fa-exclamation-triangle text-6xl text-yellow-500 mb-4"></i>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">404</h1>
            <h2 class="text-2xl font-semibold text-gray-600 mb-4">Página no encontrada</h2>
            <p class="text-gray-500 mb-8">
                Lo sentimos, la página que estás buscando no existe o ha sido movida.
            </p>
        </div>

        <div class="space-y-4">
            <a href="<?= APP_URL ?>"
                class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                <i class="fas fa-home mr-2"></i>
                Volver al inicio
            </a>

            <div class="text-sm text-gray-400">
                <p>Si crees que esto es un error, por favor contáctanos.</p>
            </div>
        </div>
    </div>
</body>

</html>