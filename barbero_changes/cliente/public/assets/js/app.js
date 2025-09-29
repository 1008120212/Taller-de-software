/**
 * Main Application File
 * Inicializa todos los módulos de la aplicación
 */
class App {
  constructor(config = {}) {
    this.config = {
      appUrl: config.appUrl || "",
      debug: config.debug || false,
      ...config,
    };

    this.modules = {};
    this.init();
  }

  init() {
    this.log("App: Initializing application...");

   
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => {
        this.initModules();
      });
    } else {
      this.initModules();
    }
  }

  initModules() {
    try {
    
      if (typeof Navigation !== "undefined") {
        this.modules.navigation = new Navigation();
        this.log("App: Navigation module initialized");
      }

    
      if (typeof Modal !== "undefined") {
        this.modules.modal = new Modal();
        this.log("App: Modal module initialized");
      }

    
      if (typeof Reservations !== "undefined") {
        this.modules.reservations = new Reservations(this.config.appUrl);
        this.log("App: Reservations module initialized");
      }

   
      this.initSwiper();

      this.initBannerRotation();

     
      this.initFullCalendar();

 
      this.setupGlobalFunctions();

      this.log("App: All modules initialized successfully");
    } catch (error) {
      console.error("App: Error initializing modules:", error);
    }
  }

  initSwiper() {
    if (typeof Swiper === "undefined") {
      this.log("App: Swiper not available");
      return;
    }

  
    const promoSwiper = document.querySelector(".promoSwiper");
    if (promoSwiper) {
      const slides = promoSwiper.querySelectorAll(".swiper-slide");
      const totalSlides = slides.length;

      if (totalSlides > 0) {
        new Swiper(".promoSwiper", {
          slidesPerView: 1,
          spaceBetween: 16,
          loop: true,
          loopFillGroupWithBlank: false,
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
            reverseDirection: false,
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          breakpoints: {
            640: {
              slidesPerView: 1.5,
              spaceBetween: 16,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            1024: {
              slidesPerView: 2.5,
              spaceBetween: 24,
            },
            1280: {
              slidesPerView: 3,
              spaceBetween: 24,
            },
            1536: {
              slidesPerView: 3.5,
              spaceBetween: 28,
            },
          },
          effect: "slide",
          speed: 800,
          grabCursor: true,
          watchSlidesProgress: true,
          watchSlidesVisibility: true,
          centeredSlides: false,
          freeMode: false,
          allowTouchMove: true,
          simulateTouch: true,
          touchRatio: 1,
          touchAngle: 45,
          longSwipes: true,
          longSwipesRatio: 0.5,
          longSwipesMs: 300,
        });
        this.log(`App: Swiper initialized with ${totalSlides} slides`);
      }
    }
  }

  initBannerRotation() {
    const bannerImg = document.getElementById("bannerImg");
    if (!bannerImg || !window.bannerData) {
      this.log("App: Banner rotation not available");
      return;
    }

    let currentBanner = 0;
    const { images, interval } = window.bannerData;

    if (images && images.length > 1) {
      setInterval(() => {
        currentBanner = (currentBanner + 1) % images.length;
        bannerImg.src = images[currentBanner];
      }, interval);
      this.log("App: Banner rotation initialized");
    }
  }

  initFullCalendar() {
    if (typeof FullCalendar === "undefined") {
      this.log("App: FullCalendar not available");
      return;
    }

    const calendarEl = document.getElementById("calendar");
    if (calendarEl) {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        locale: "es",
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek",
        },
        events: `${this.config.appUrl}/public/api/eventos.php`,
        eventClick: function (info) {
      
          console.log("Event clicked:", info.event);
        },
      });
      calendar.render();
      this.log("App: FullCalendar initialized");
    }
  }

  setupGlobalFunctions() {
 
    window.seleccionarServicio = (servicioId) => {
      if (this.modules.reservations) {
        this.modules.reservations.selectService(servicioId);
      }
    };

    window.seleccionarPromocion = (promoId) => {
      if (this.modules.reservations) {
        this.modules.reservations.selectPromotion(promoId);
      }
    };

    window.cargarHorarios = (fecha, barberoId) => {
      if (this.modules.reservations) {
        this.modules.reservations.loadTimeSlots(fecha, barberoId);
      }
    };

    window.formatTime = (timeStr) => {
      if (this.modules.reservations) {
        return this.modules.reservations.formatTime(timeStr);
      }
      return timeStr;
    };

    this.log("App: Global functions set up");
  }

  log(message) {
    if (this.config.debug) {
      console.log(message);
    }
  }

  
  getModule(name) {
    return this.modules[name] || null;
  }


  addModule(name, moduleInstance) {
    this.modules[name] = moduleInstance;
    this.log(`App: Custom module "${name}" added`);
  }
}


document.addEventListener("DOMContentLoaded", function () {
  
  const appConfig = {
    appUrl: window.APP_URL || "",
    debug: window.APP_DEBUG || false,
  };

 
  window.barberoApp = new App(appConfig);

  // Botón logout desktop
  const logoutBtn = document.getElementById("logoutBtn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", function () {
      fetch("/barbero/cliente/public/api/auth/logout.php", { method: "POST", credentials: "same-origin" })
        .then(() => window.location.reload());
    });
  }
  // Botón logout móvil
  const logoutBtnMobile = document.getElementById("logoutBtnMobile");
  if (logoutBtnMobile) {
    logoutBtnMobile.addEventListener("click", function () {
      fetch("/barbero/cliente/public/api/auth/logout.php", { method: "POST", credentials: "same-origin" })
        .then(() => window.location.reload());
    });
  }
});


if (typeof module !== "undefined" && module.exports) {
  module.exports = App;
}
