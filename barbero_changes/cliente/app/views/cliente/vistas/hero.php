<section id="inicio" class="relative bg-black text-white h-screen overflow-hidden">
    <!-- Imagen de fondo -->
    <div class="absolute inset-0 z-0">
        <img id="bannerImg" src="<?= $bannerImages[0] ?>"
            alt="Barbería de lujo con sillón vintage y herramientas profesionales"
            class="w-full h-full object-cover opacity-70 transition-all duration-1000">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/90"></div>
    </div>

    <!-- Contenido Principal -->
    <div class="absolute inset-0 flex flex-col justify-center text-center z-10 pb-72 sm:pb-80 md:pb-84 lg:pb-96 pt-20">
        <div class="px-4 max-w-5xl mx-auto">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-serif font-bold mb-4 tracking-wide">
                EXPERIENCIA BARBERÍA PREMIUM
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl mb-8 text-gray-200 max-w-3xl mx-auto">
                Reserva online en 3 simples pasos y disfruta del mejor servicio de barbería
            </p>
            <!-- Botones  Solo en móviles -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8 lg:hidden">
                <a href="#reservas"
                    class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-4 px-8 rounded-full transition-all duration-300 inline-flex items-center justify-center text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                    <i class="fas fa-calendar-check mr-3"></i>
                    RESERVAR AHORA
                </a>
                <a href="#servicios"
                    class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-bold py-4 px-8 rounded-full transition-all duration-300 inline-flex items-center justify-center text-lg border-2 border-white/30 hover:border-white/50">
                    <i class="fas fa-scissors mr-3"></i>
                    VER SERVICIOS
                </a>
            </div>
        </div>
    </div>

    <!-- Slider de Promociones  -->
    <div
        class="absolute bottom-0 left-0 right-0 z-20 bg-gradient-to-t from-slate-900 via-slate-800 to-transparent py-6">
        <div class="container mx-auto px-4">
            <div class="swiper promoSwiper h-48 sm:h-52 md:h-56 lg:h-60">
                <div class="swiper-wrapper">
                    <?php if (!empty($promociones)): ?>
                        <!-- Mostrar cantidad de promociones -->
                        <script>console.log('Promociones cargadas:', <?= count($promociones) ?>);</script>
                        <?php foreach ($promociones as $promo): ?>
                            <div class="swiper-slide">

                                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden mx-2 h-full relative">

                                    <div class="absolute top-2 right-2 z-20">
                                        <div
                                            class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-sm sm:text-base font-bold px-2 py-1 sm:px-3 sm:py-2 rounded-full shadow-lg animate-bounce">
                                            -<?= $promo['descuento_porcentaje'] ?>%
                                        </div>
                                    </div>

                                    <!-- Layout Horizontal Responsivo -->
                                    <div class="flex h-full">
                                        <!-- Imagen de la Promoción -->
                                        <div
                                            class="w-3/5 sm:w-3/5 p-2 sm:p-3 md:p-4 flex flex-col justify-between bg-gradient-to-br from-white to-gray-50">
                                            <!-- Título -->
                                            <h4
                                                class="text-xs sm:text-sm md:text-base font-bold text-gray-800 mb-1 line-clamp-1">
                                                <?= htmlspecialchars($promo['titulo']) ?>
                                            </h4>

                                            <!-- Descripción -->
                                            <p class="text-gray-600 text-xs mb-1 sm:mb-2 line-clamp-2 leading-relaxed">
                                                <?= htmlspecialchars($promo['descripcion']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                <?php endif; ?>
            </div>
            <!-- Navegación -->
        </div>
    </div>
    </div>
</section>


<script>
    // Banner rotation data for the app
    window.bannerData = {
        images: <?= json_encode($bannerImages) ?>,
        interval: 5000
    };
</script>