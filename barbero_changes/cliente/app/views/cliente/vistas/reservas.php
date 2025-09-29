<?php
require_once dirname(__DIR__, 3) . '/config/config.php';
?>
<section id="reservas" class="py-12 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="container mx-auto px-4">
        <?php if (!isset($_SESSION['cliente_logged_in']) || $_SESSION['cliente_logged_in'] !== true): ?>
            <div class="flex justify-center items-center min-h-[350px]">
                <div class="w-full max-w-2xl bg-amber-50 border-4 border-amber-400 rounded-2xl shadow-2xl p-10 flex flex-col items-center">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-lock text-4xl mr-4 text-amber-500"></i>
                        <span class="text-2xl font-bold text-amber-900">Debes iniciar sesión o registrarte para poder hacer una reserva</span>
                    </div>
                    <div class="flex space-x-6 mt-4">
                        <button onclick="openAuthModal(); showLoginForm();" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg text-lg flex items-center transition-all duration-300">
                            <i class="fas fa-sign-in-alt mr-3"></i> Iniciar Sesión
                        </button>
                        <button onclick="openAuthModal(); showRegisterForm();" class="bg-white border-2 border-amber-500 text-amber-600 font-bold py-3 px-8 rounded-xl shadow-lg text-lg flex items-center transition-all duration-300">
                            <i class="fas fa-user-plus mr-3"></i> Registrarse
                        </button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Formulario de reservas solo visible si está logueado -->
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-serif font-bold mb-2 text-gray-800">RESERVA TU CITA</h2>
                <p class="text-gray-600 text-sm md:text-base">Sistema rápido y sencillo en 3 pasos</p>
            </div>

            <div class="flex justify-center items-center mb-8">
                <div class="flex items-center space-x-4 md:space-x-8">
                  
                    <div class="flex items-center">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                1
                            </div>
                            <span class="text-xs font-medium text-gray-700 mt-1 hidden sm:block">Servicio</span>
                        </div>
                        <div class="w-8 md:w-16 h-0.5 bg-amber-300 mx-2"></div>
                    </div>
                    
                 
                    <div class="flex items-center">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                2
                            </div>
                            <span class="text-xs font-medium text-gray-700 mt-1 hidden sm:block">Fecha/Hora</span>
                        </div>
                        <div class="w-8 md:w-16 h-0.5 bg-amber-300 mx-2"></div>
                    </div>
                    
                 
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                            3
                        </div>
                        <span class="text-xs font-medium text-gray-700 mt-1 hidden sm:block">Confirmar</span>
                    </div>
                </div>
            </div>

            <!-- Formulario  -->
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <form id="bookingForm" action="<?= APP_URL ?>/public/index.php?controller=cliente&action=reservar" method="POST">
                        
                        <!-- Header del Formulario -->
                        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                            <h3 class="text-white font-bold text-lg flex items-center">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Completa tu Reserva
                            </h3>
                        </div>

                        <div class="p-6">
                            <!-- Grid Principal -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                
                                <!-- Columna 1: Datos Personales -->
                                <div class="space-y-4">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-user text-amber-500 mr-2"></i>
                                        <h4 class="font-semibold text-gray-800">Tus Datos</h4>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo*</label>
                                        <div class="relative">
                                            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <input type="text" id="name" name="name" required
                                                class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all<?= isset($_SESSION['cliente_nombre']) ? ' bg-gray-100 text-gray-700' : '' ?>"
                                                value="<?= isset($_SESSION['cliente_nombre']) ? htmlspecialchars($_SESSION['cliente_nombre']) : '' ?>">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono*</label>
                                        <div class="relative">
                                            <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <input type="tel" id="phone" name="phone" required
                                                class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all<?= isset($_SESSION['cliente_telefono']) ? ' bg-gray-100 text-gray-700' : '' ?>"
                                                value="<?= isset($_SESSION['cliente_telefono']) ? htmlspecialchars($_SESSION['cliente_telefono']) : '' ?>">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                                        <div class="relative">
                                            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <input type="email" id="email" name="email" required
                                                class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all<?= isset($_SESSION['cliente_email']) ? ' bg-gray-100 text-gray-700' : '' ?>"
                                                value="<?= isset($_SESSION['cliente_email']) ? htmlspecialchars($_SESSION['cliente_email']) : '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna 2: Detalles del Servicio -->
                                <div class="space-y-4">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-cut text-amber-500 mr-2"></i>
                                        <h4 class="font-semibold text-gray-800">Servicio</h4>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Servicio*</label>
                                        <div class="relative">
                                            <i class="fas fa-scissors absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <select id="service" name="service_id" required
                                                class="w-full pl-9 pr-8 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent appearance-none transition-all">
                                                <option value="">Selecciona un servicio</option>
                                                <?php $first = true; foreach ($servicios as $servicio): ?>
                                                <option value="<?= $servicio['id'] ?>" 
                                                    data-precio="<?= $servicio['precio'] ?>"
                                                    data-duracion="<?= $servicio['duracion'] ?>"
                                                    <?= $first ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($servicio['nombre']) ?> - S/<?= number_format($servicio['precio'], 2) ?>
                                                </option>
                                                <?php $first = false; endforeach; ?>
                                            </select>
                                            <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Barbero Preferido</label>
                                        <div class="relative">
                                            <i class="fas fa-user-tie absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <select id="barber" name="barbero_id"
                                                class="w-full pl-9 pr-8 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent appearance-none transition-all">
                                                <option value="">Cualquier barbero</option>
                                                <?php foreach ($barberos as $barbero): ?>
                                                <option value="<?= $barbero['id'] ?>">
                                                    <?= htmlspecialchars($barbero['nombre']) ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Preferida*</label>
                                        <div class="relative">
                                            <i class="fas fa-calendar-day absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <input type="date" id="date" name="fecha" required 
                                                   min="<?= date('Y-m-d') ?>"
                                                   class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna 3: Horarios y Notas -->
                                <div class="space-y-4">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-clock text-amber-500 mr-2"></i>
                                        <h4 class="font-semibold text-gray-800">Horario</h4>
                                    </div>
                                    
                                    <!-- Horarios Disponibles -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Horarios Disponibles*</label>
                                        <div id="timeSlotsGrid" class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto">
                                            <div class="col-span-2 text-center text-gray-500 text-sm py-4">
                                                Selecciona una fecha para ver horarios
                                            </div>
                                        </div>
                                        <div id="noSlotsMessage" class="text-center text-gray-500 text-sm py-4 hidden">
                                            No hay horarios disponibles para esta fecha
                                        </div>
                                    </div>
                            
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Notas Especiales</label>
                                        <div class="relative">
                                            <i class="fas fa-edit absolute left-3 top-3 text-gray-400 text-sm"></i>
                                            <textarea id="notes" name="notas" rows="3"
                                                class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all resize-none"
                                                placeholder="Alguna preferencia especial..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campos Ocultos -->
                            <input type="hidden" id="selectedTime" name="hora_inicio">
                            <input type="hidden" id="selectedServicePrice" name="precio">
                            <?php if (isset($_SESSION['cliente_id'])): ?>
                                <input type="hidden" name="cliente_id" value="<?= (int)$_SESSION['cliente_id'] ?>">
                            <?php endif; ?>

                            <!-- Botón de Reserva -->
                            <div class="mt-8 text-center">
                                <button type="submit"
                                    class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-3 px-8 rounded-full transition-all duration-300 flex items-center justify-center mx-auto shadow-lg hover:shadow-xl transform hover:-translate-y-1 min-w-48">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    CONFIRMAR RESERVA
                                </button>
                                <p class="text-xs text-gray-500 mt-2">Recibirás una confirmación por email</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

