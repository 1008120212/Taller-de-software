<?php
require_once dirname(__DIR__, 2) . '/config/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - <?= $titulo ?? 'Sistema de Reservas' ?></title>
    <meta name="description" content="Sistema profesional de reservas para barbería">

    <!--Css externo  -->
    <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/css/main.css">

    <!-- librerias externas -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= APP_URL ?>/public/assets/js/tailwind.config.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9.4.1/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header
        class="bg-slate-900/95 backdrop-blur-md text-white shadow-2xl fixed top-0 left-0 right-0 z-40 border-b border-slate-700/50">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo y Marca -->
                <div class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div
                            class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-amber-500/25 transition-all duration-300 group-hover:scale-105">
                            <i class="fas fa-cut text-white text-lg lg:text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1
                            class="text-xl lg:text-2xl font-bold font-serif bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                            <?= APP_NAME ?>
                        </h1>
                    </div>
                </div>

                <!-- Navegación y CTA Desktop -->
                <div class="hidden lg:flex items-center space-x-6">
                    <nav class="flex items-center space-x-1">
                        <a href="#inicio"
                            class="nav-link group relative px-4 py-2 rounded-lg transition-all duration-300 hover:bg-white/10">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-home text-sm"></i>
                                <span class="font-medium">Inicio</span>
                            </span>
                            <div
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-amber-400 to-amber-600 group-hover:w-full transition-all duration-300">
                            </div>
                        </a>
                        <a href="#servicios"
                            class="nav-link group relative px-4 py-2 rounded-lg transition-all duration-300 hover:bg-white/10">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-scissors text-sm"></i>
                                <span class="font-medium">Servicios</span>
                            </span>
                            <div
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-amber-400 to-amber-600 group-hover:w-full transition-all duration-300">
                            </div>
                        </a>
                    </nav>

                    <a href="#reservas"
                        class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-2.5 px-6 rounded-full transition-all duration-300 shadow-lg hover:shadow-amber-500/25 transform hover:scale-105 flex items-center space-x-2">
                        <i class="fas fa-calendar-plus text-sm"></i>
                        <span>Reservar</span>
                    </a>

                    <?php if (isset($_SESSION['cliente_logged_in']) && $_SESSION['cliente_logged_in'] === true): ?>
                        <!-- Menú de Usuario -->
                        <div id="userMenu" class="relative">
                            <button id="userMenuBtn" type="button"
                                class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center space-x-2 shadow-lg">
                                <i class="fas fa-user-circle text-sm"></i>
                                <span id="userName"><?php echo htmlspecialchars($_SESSION['cliente_nombre']); ?></span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <!-- Menú desplegable -->
                            <div id="userDropdown"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-2 hidden z-50">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900" id="userEmail">
                                        <?php echo htmlspecialchars($_SESSION['cliente_email']); ?>
                                    </p>
                                    <p class="text-xs text-gray-500">Cliente</p>
                                </div>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-user mr-2"></i>Mi Perfil
                                </a>
                                <a href="#reservas"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-calendar mr-2"></i>Mis Reservas
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <button id="logoutBtn" type="button"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Botón de Inicio de Sesión -->
                        <button id="loginBtn"
                            class="bg-white/10 hover:bg-white/20 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center space-x-2 border border-white/20">
                            <i class="fas fa-user text-sm"></i>
                            <span>Iniciar Sesión</span>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Botón Menú Móvil -->
                <button id="mobileMenuButton"
                    class="lg:hidden relative w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center transition-all duration-300 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <div class="hamburger-lines">
                        <span class="line line1 block w-5 h-0.5 bg-white transition-all duration-300"></span>
                        <span class="line line2 block w-5 h-0.5 bg-white transition-all duration-300"></span>
                        <span class="line line3 block w-5 h-0.5 bg-white transition-all duration-300"></span>
                    </div>
                </button>
            </div>
        </div>

        <!-- Menú Móvil  -->
        <div id="mobileMenu" class="lg:hidden fixed inset-0 bg-slate-900 border-t border-slate-700 z-50"
            style="top: 64px;">
            <div class="container mx-auto px-4 py-6">
                <nav class="space-y-2">
                    <a href="#inicio"
                        class="mobile-nav-link flex items-center space-x-4 p-4 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-home text-white"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-white">Inicio</span>
                            <p class="text-sm text-gray-400">Página principal</p>
                        </div>
                        <i
                            class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-amber-400 transition-colors duration-300"></i>
                    </a>

                    <a href="#servicios"
                        class="mobile-nav-link flex items-center space-x-4 p-4 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-scissors text-white"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-white">Servicios</span>
                            <p class="text-sm text-gray-400">Nuestros cortes</p>
                        </div>
                        <i
                            class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-amber-400 transition-colors duration-300"></i>
                    </a>

                    <?php if (isset($_SESSION['cliente_logged_in']) && $_SESSION['cliente_logged_in'] === true): ?>
                        <!-- Menú de Usuario Móvil -->
                        <div
                            class="mobile-nav-link flex items-center space-x-4 p-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 text-white">
                            <i class="fas fa-user-circle"></i>
                            <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['cliente_nombre']); ?></span>
                        </div>
                        <a href="#reservas"
                            class="mobile-nav-link flex items-center space-x-4 p-4 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                            <i class="fas fa-calendar"></i>
                            <span class="font-semibold">Mis Reservas</span>
                        </a>
                        <button id="logoutBtnMobile"
                            class="mobile-nav-link flex items-center space-x-4 p-4 rounded-xl hover:bg-red-100 text-red-600 transition-all duration-300 group w-full text-left">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="font-semibold">Cerrar Sesión</span>
                        </button>
                    <?php else: ?>
                        <!-- Botón de Inicio de Sesión Móvil -->
                        <button id="loginBtnMobile"
                            class="mobile-nav-link flex items-center space-x-4 p-4 rounded-xl hover:bg-white/10 transition-all duration-300 group w-full text-left">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <span class="font-semibold text-white">Iniciar Sesión</span>
                                <p class="text-sm text-gray-400">Accede a tu cuenta</p>
                            </div>
                            <i
                                class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-amber-400 transition-colors duration-300"></i>
                        </button>
                    <?php endif; ?>
                </nav>

                <!-- Info de Contacto -->
                <div class="mt-6 pt-6 border-t border-slate-700/50">
                    <div class="flex items-center justify-center space-x-6 text-gray-400">
                        <a href="tel:+51999999999"
                            class="flex items-center space-x-2 hover:text-amber-400 transition-colors duration-300">
                            <i class="fas fa-phone"></i>
                            <span class="text-sm">Llamar</span>
                        </a>
                        <a href="https://wa.me/51999999999"
                            class="flex items-center space-x-2 hover:text-green-400 transition-colors duration-300">
                            <i class="fab fa-whatsapp"></i>
                            <span class="text-sm">WhatsApp</span>
                        </a>
                        <a href="#" id="ubicacionBtn"
                            class="flex items-center space-x-2 hover:text-blue-400 transition-colors duration-300">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="text-sm">Ubicación</span>
                        </a>
                    </div>
                </div>
    </header>

    <!-- Modal de Inicio de Sesión y Registro -->
    <div id="authModal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">

            <!-- Header del Modal -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg" id="authModalTitle">Iniciar Sesión</h3>
                        <p class="text-gray-300 text-sm" id="authModalSubtitle">Accede a tu cuenta</p>
                    </div>
                </div>
                <button id="cerrarAuthModal"
                    class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>

            <!-- Contenido del Modal -->
            <div class="p-6">
                <!-- Formulario de Login -->
                <form id="loginForm" class="space-y-4">
                    <div>
                        <label for="loginEmail" class="block text-sm font-medium text-gray-700 mb-2">Correo
                            Electrónico</label>
                        <input type="email" id="loginEmail" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="tu@email.com">
                    </div>

                    <div>
                        <label for="loginPassword"
                            class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                        <input type="password" id="loginPassword" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 shadow-lg transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </button>
                </form>

                <!-- Formulario de Registro -->
                <form id="registerForm" class="space-y-4 hidden">
                    <div>
                        <label for="registerNombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre
                            Completo</label>
                        <input type="text" id="registerNombre" name="nombre" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="Tu nombre completo">
                    </div>

                    <div>
                        <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-2">Correo
                            Electrónico</label>
                        <input type="email" id="registerEmail" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="tu@email.com">
                    </div>

                    <div>
                        <label for="registerTelefono"
                            class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                        <input type="tel" id="registerTelefono" name="telefono" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="+51 999 999 999">
                    </div>

                    <div>
                        <label for="registerPassword"
                            class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                        <input type="password" id="registerPassword" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="••••••••">
                    </div>

                    <div>
                        <label for="registerPasswordConfirm"
                            class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                        <input type="password" id="registerPasswordConfirm" name="password_confirm" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-300"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 shadow-lg transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>
                        Crear Cuenta
                    </button>
                </form>

                <!-- Enlaces de cambio de formulario -->
                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-600 mb-3"></p>
                    <button id="showRegisterForm"
                        class="text-amber-600 hover:text-amber-700 font-medium transition-colors duration-300">
                        Regístrate aquí
                    </button>

                    <p class="text-gray-600 mb-3 mt-4 hidden" id="loginPrompt">¿Ya tienes cuenta?</p>
                    <button id="showLoginForm"
                        class="text-amber-600 hover:text-amber-700 font-medium transition-colors duration-300 hidden">
                        Inicia sesión aquí
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Contenido principal -->
    <main>
        <?php require_once $contenido; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4"><?= APP_NAME ?></h3>
                    <p class="text-gray-300">Sistema profesional de reservas para barbería</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contacto</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-phone mr-2"></i> +51 999 999 999</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@baber.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Av. ...</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-secondary transition">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-secondary transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-secondary transition">
                            <i class="fab fa-whatsapp text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; <?= date('Y') ?> <?= APP_NAME ?>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!--libreria js externos -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9.4.1/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.js"></script>

    <!-- Application JavaScript Modules -->
    <script src="<?= APP_URL ?>/public/assets/js/navigation.js"></script>
    <script src="<?= APP_URL ?>/public/assets/js/modal.js"></script>
    <script src="<?= APP_URL ?>/public/assets/js/reservations.js"></script>
    <script src="<?= APP_URL ?>/public/assets/js/app.js"></script>


    <script>
        window.APP_URL = '<?= APP_URL ?>';
        window.APP_DEBUG = <?= defined('APP_DEBUG') && APP_DEBUG ? 'true' : 'false' ?>;

        // Funciones globales para el modal de autenticación
        function openAuthModal() {
            const authModal = document.getElementById('authModal');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const authModalTitle = document.getElementById('authModalTitle');
            const authModalSubtitle = document.getElementById('authModalSubtitle');
            const showRegisterFormBtn = document.getElementById('showRegisterForm');
            const showLoginFormBtn = document.getElementById('showLoginForm');
            const loginPrompt = document.getElementById('loginPrompt');
            authModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            // Mostrar formulario de login por defecto
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            authModalTitle.textContent = 'Iniciar Sesión';
            authModalSubtitle.textContent = 'Accede a tu cuenta';
            showRegisterFormBtn.classList.remove('hidden');
            loginPrompt.classList.add('hidden');
            showLoginFormBtn.classList.add('hidden');
        }
        function closeAuthModal() {
            const authModal = document.getElementById('authModal');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            authModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            loginForm.reset();
            registerForm.reset();
        }
        function showRegisterForm() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const authModalTitle = document.getElementById('authModalTitle');
            const authModalSubtitle = document.getElementById('authModalSubtitle');
            const showRegisterFormBtn = document.getElementById('showRegisterForm');
            const showLoginFormBtn = document.getElementById('showLoginForm');
            const loginPrompt = document.getElementById('loginPrompt');
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            authModalTitle.textContent = 'Crear Cuenta';
            authModalSubtitle.textContent = 'Regístrate para continuar';
            showRegisterFormBtn.classList.add('hidden');
            loginPrompt.classList.remove('hidden');
            showLoginFormBtn.classList.remove('hidden');
        }
        function showLoginForm() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const authModalTitle = document.getElementById('authModalTitle');
            const authModalSubtitle = document.getElementById('authModalSubtitle');
            const showRegisterFormBtn = document.getElementById('showRegisterForm');
            const showLoginFormBtn = document.getElementById('showLoginForm');
            const loginPrompt = document.getElementById('loginPrompt');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            authModalTitle.textContent = 'Iniciar Sesión';
            authModalSubtitle.textContent = 'Accede a tu cuenta';
            showRegisterFormBtn.classList.remove('hidden');
            loginPrompt.classList.add('hidden');
            showLoginFormBtn.classList.add('hidden');
        }
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM Content Loaded - Starting initialization...');

            // Verificar que los elementos del menú móvil existen
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            console.log('Mobile menu button:', mobileMenuButton);
            console.log('Mobile menu:', mobileMenu);

            // Inicializar navegación directamente si no funciona con la clase
            if (mobileMenuButton && mobileMenu) {
                console.log('Setting up mobile menu manually...');

                mobileMenuButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Mobile menu button clicked');

                    const isOpen = mobileMenu.classList.contains('show');
                    console.log('Menu is currently open:', isOpen);

                    const hamburgerLines = document.querySelector('.hamburger-lines');

                    if (isOpen) {
                        mobileMenu.classList.remove('show');
                        if (hamburgerLines) hamburgerLines.classList.remove('active');
                        document.body.style.overflow = 'auto';
                        console.log('Menu closed');
                    } else {
                        mobileMenu.classList.add('show');
                        if (hamburgerLines) hamburgerLines.classList.add('active');
                        document.body.style.overflow = 'hidden';
                        console.log('Menu opened');
                    }
                });

                // Cerrar menú al hacer clic en enlaces
                const mobileLinks = mobileMenu.querySelectorAll('a[href^="#"]');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function () {
                        mobileMenu.classList.remove('show');
                        const hamburgerLines = document.querySelector('.hamburger-lines');
                        if (hamburgerLines) hamburgerLines.classList.remove('active');
                        document.body.style.overflow = 'auto';
                        console.log('Menu closed by link click');
                    });
                });

                // Cerrar menú al hacer clic fuera de él
                document.addEventListener('click', function (e) {
                    if (mobileMenu.classList.contains('show')) {
                        if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                            mobileMenu.classList.remove('show');
                            const hamburgerLines = document.querySelector('.hamburger-lines');
                            if (hamburgerLines) hamburgerLines.classList.remove('active');
                            document.body.style.overflow = 'auto';
                            console.log('Menu closed by outside click');
                        }
                    }
                });
            }

            // Initialize the main application
            if (typeof App !== 'undefined') {
                window.app = new App({
                    appUrl: window.APP_URL,
                    debug: window.APP_DEBUG
                });
                console.log('App initialized');
            } else {
                console.error('App class not found');
            }

            // Verificar estado de autenticación
            checkAuthStatus();

            if (window.APP_DEBUG) {
                console.log('Application initialized with config:', {
                    appUrl: window.APP_URL,
                    debug: window.APP_DEBUG
                });
            }

            // Event listeners para botones de login (reemplazar los duplicados)
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnMobile = document.getElementById('loginBtnMobile');

            if (loginBtn) {
                loginBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Login button clicked');
                    openAuthModal();
                });
            }

            if (loginBtnMobile) {
                loginBtnMobile.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Mobile login button clicked');
                    openAuthModal();
                });
            }

            // Event listeners para botones de logout
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutBtnMobile = document.getElementById('logoutBtnMobile');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Logout button clicked');
                    logout();
                });
            }

            if (logoutBtnMobile) {
                logoutBtnMobile.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Mobile logout button clicked');
                    logout();
                });
            }

            // Event listeners para el modal de autenticación
            const cerrarAuthModal = document.getElementById('cerrarAuthModal');
            const showRegisterFormBtn = document.getElementById('showRegisterForm');
            const showLoginFormBtn = document.getElementById('showLoginForm');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            if (cerrarAuthModal) {
                cerrarAuthModal.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Close auth modal clicked');
                    closeAuthModal();
                });
            }

            if (showRegisterFormBtn) {
                showRegisterFormBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Show register form clicked');
                    showRegisterForm();
                });
            }

            if (showLoginFormBtn) {
                showLoginFormBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Show login form clicked');
                    showLoginForm();
                });
            }

            // Cerrar modal al hacer clic fuera
            const authModal = document.getElementById('authModal');
            if (authModal) {
                authModal.addEventListener('click', function (e) {
                    if (e.target === authModal) {
                        console.log('Auth modal outside click');
                        closeAuthModal();
                    }
                });
            }

            // Manejar envío del formulario de login
            if (loginForm) {
                loginForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    console.log('Login form submitted');
                    const formData = new FormData(loginForm);

                    // Mostrar loading
                    const submitBtn = loginForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Iniciando...';
                    submitBtn.disabled = true;

                    // Enviar datos al servidor
                    fetch(window.APP_URL + '/public/api/auth/login.php', {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Credenciales incorrectas',
                                    confirmButtonColor: '#d97706'
                                });
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo conectar con el servidor',
                                confirmButtonColor: '#d97706'
                            });
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // Manejar envío del formulario de registro
            if (registerForm) {
                registerForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    console.log('Register form submitted');
                    const formData = new FormData(registerForm);

                    // Validar contraseñas
                    const password = formData.get('password');
                    const passwordConfirm = formData.get('password_confirm');

                    if (password !== passwordConfirm) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Las contraseñas no coinciden'
                        });
                        return;
                    }

                    // Mostrar loading
                    const submitBtn = registerForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creando cuenta...';
                    submitBtn.disabled = true;

                    // Enviar datos al servidor
                    fetch(window.APP_URL + '/public/api/auth/register.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                handleRegisterSuccess(data.cliente);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al conectar con el servidor'
                            });
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }

            // Menú desplegable usuario (desktop)
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');
            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                // Cerrar menú al hacer clic fuera
                document.addEventListener('click', function (e) {
                    if (!userDropdown.classList.contains('hidden') && !userDropdown.contains(e.target) && e.target !== userMenuBtn) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }

            // Evento para 'Mi Perfil'
            const perfilLink = document.querySelector('#userDropdown a[href="#"]');
            if (perfilLink) {
                perfilLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'Mi Perfil',
                        text: 'Aquí irá el modal de perfil del cliente.',
                        confirmButtonColor: '#d97706'
                    });
                });
            }
        });

        // Función para verificar el estado de autenticación
        async function checkAuthStatus() {
            try {
                const response = await fetch('api/auth/check.php');
                const data = await response.json();

                if (data.success && data.cliente) {
                    showUserMenu(data.cliente);
                } else {
                    showLoginButton();
                }
            } catch (error) {
                console.error('Error verificando estado de autenticación:', error);
                showLoginButton();
            }
        }

        // Función para cerrar sesión
        async function logout() {
            try {
                const response = await fetch('api/auth/logout.php', {
                    method: 'GET'
                });
                if (!response.ok) {
                    let msg = 'Error de conexión al cerrar sesión: ' + response.status;
                    try {
                        const data = await response.json();
                        if (data && data.message) msg = data.message;
                    } catch { }
                    throw new Error(msg);
                }
                const data = await response.json();
                if (data.success) {
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Error al cerrar sesión',
                        confirmButtonColor: '#f59e0b'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message,
                    confirmButtonColor: '#f59e0b'
                });
            }
        }

        // Función para mostrar el menú de usuario
        function showUserMenu(cliente) {
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnMobile = document.getElementById('loginBtnMobile');
            const userMenu = document.getElementById('userMenu');
            const userName = document.getElementById('userName');
            const userEmail = document.getElementById('userEmail');

            // Ocultar botones de login
            loginBtn.classList.add('hidden');
            loginBtnMobile.classList.add('hidden');

            // Mostrar menú de usuario si existe
            if (userMenu) {
                userMenu.classList.remove('hidden');
                if (userName) userName.textContent = cliente.nombre;
                if (userEmail) userEmail.textContent = cliente.email;
                // Inicializar el menú dropdown
                initializeUserDropdown();
            }
        }

        // Función para mostrar el botón de login
        function showLoginButton() {
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnMobile = document.getElementById('loginBtnMobile');
            const userMenu = document.getElementById('userMenu');

            // Mostrar botones de login
            loginBtn.classList.remove('hidden');
            loginBtnMobile.classList.remove('hidden');

            // Ocultar menú de usuario si existe
            if (userMenu) {
                userMenu.classList.add('hidden');
            }
        }

        // Función para inicializar el menú desplegable del usuario
        function initializeUserDropdown() {
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');
            const userDropdownLogoutBtn = document.getElementById('logoutBtn');
            const perfilLink = userDropdown.querySelector('a:has(i.fa-user)');
            const reservasLink = userDropdown.querySelector('a:has(i.fa-calendar)');

            if (!userMenuBtn || !userDropdown) return;

            // Evitar múltiples listeners
            if (userMenuBtn.dataset.listener === 'true') return;
            userMenuBtn.dataset.listener = 'true';

            // Toggle del menú desplegable
            userMenuBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });

            // Cerrar menú al hacer clic fuera
            document.addEventListener('click', function (e) {
                if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });

            // Manejar cierre de sesión desde el dropdown
            if (userDropdownLogoutBtn) {
                userDropdownLogoutBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    logout();
                    userDropdown.classList.add('hidden');
                });
            }

            // Manejar clic en 'Mi Perfil'
            if (perfilLink) {
                perfilLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const userName = document.getElementById('userName').textContent;
                    const userEmail = document.getElementById('userEmail').textContent;
                    Swal.fire({
                        icon: 'info',
                        title: 'Mi Perfil',
                        html: `<b>Nombre:</b> ${userName}<br><b>Email:</b> ${userEmail}`,
                        confirmButtonColor: '#f59e0b',
                        confirmButtonText: 'Cerrar'
                    });
                    userDropdown.classList.add('hidden');
                });
            }

            // Manejar clic en 'Mis Reservas'
            if (reservasLink) {
                reservasLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    showMyReservations();
                    userDropdown.classList.add('hidden');
                });
            }
        }

        // Función para manejar login exitoso
        function handleLoginSuccess(cliente) {
            // Cerrar modal
            const modal = document.getElementById('authModal');
            if (modal) {
                modal.classList.add('hidden');
            }

            // Mostrar mensaje de éxito
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                text: `Hola ${cliente.nombre}, has iniciado sesión correctamente.`,
                confirmButtonColor: '#f59e0b'
            });

            // Actualizar interfaz
            showUserMenu(cliente);

            // Limpiar formularios
            document.getElementById('loginForm').reset();
            document.getElementById('registerForm').reset();
        }

        // Función para manejar registro exitoso
        function handleRegisterSuccess(cliente) {
            // Cerrar modal
            const modal = document.getElementById('authModal');
            if (modal) {
                modal.classList.add('hidden');
            }

            // Mostrar mensaje de éxito
            Swal.fire({
                icon: 'success',
                title: '¡Cuenta creada!',
                text: `Hola ${cliente.nombre}, tu cuenta ha sido creada exitosamente.`,
                confirmButtonColor: '#f59e0b'
            });

            // Actualizar interfaz
            showUserMenu(cliente);

            // Limpiar formularios
            document.getElementById('loginForm').reset();
            document.getElementById('registerForm').reset();
        }
    </script>
</body>

</html>