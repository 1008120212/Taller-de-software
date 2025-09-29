/**
 * Maneja la navegación principal y el menú móvil
 */
class Navigation {
  constructor() {
    this.mobileMenuButton = document.getElementById("mobileMenuButton");
    this.mobileMenu = document.getElementById("mobileMenu");
    this.hamburgerLines = document.querySelector(".hamburger-lines");
    this.navLinks = document.querySelectorAll(".nav-link");

    this.init();
  }

  init() {
    if (!this.mobileMenuButton || !this.mobileMenu) {
      console.error("Navigation: Mobile menu elements not found!");
      return;
    }

    this.bindEvents();
    this.setActiveNav();
    console.log("Navigation: Initialized successfully");
  }

  bindEvents() {
    // Mobile menu
    this.mobileMenuButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      this.toggleMobileMenu();
    });

    // Close menu 
    const allMobileLinks = this.mobileMenu.querySelectorAll('a[href^="#"]');
    allMobileLinks.forEach((link) => {
      link.addEventListener("click", () => {
        this.closeMobileMenu();
      });
    });

   
    document.addEventListener("click", (e) => {
      if (this.mobileMenu.classList.contains("show")) {
        if (
          !this.mobileMenuButton.contains(e.target) &&
          !this.mobileMenu.contains(e.target)
        ) {
          this.closeMobileMenu();
        }
      }
    });

    
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", (e) => {
        e.preventDefault();
        this.scrollToSection(anchor.getAttribute("href"));
      });
    });

    
    window.addEventListener("scroll", () => this.setActiveNav());

   
    this.initLogoEffect();
  }

  toggleMobileMenu() {
    const isOpen = this.mobileMenu.classList.contains("show");

    if (isOpen) {
      this.closeMobileMenu();
    } else {
      this.openMobileMenu();
    }
  }

  openMobileMenu() {
    this.mobileMenu.classList.add("show");
    if (this.hamburgerLines) this.hamburgerLines.classList.add("active");
    document.body.style.overflow = "hidden";
    console.log("Navigation: Menu opened");
  }

  closeMobileMenu() {
    this.mobileMenu.classList.remove("show");
    if (this.hamburgerLines) this.hamburgerLines.classList.remove("active");
    document.body.style.overflow = "auto";
    console.log("Navigation: Menu closed");
  }

  scrollToSection(href) {
    const target = document.querySelector(href);
    if (target) {
      const headerHeight = 80;
      const targetPosition = target.offsetTop - headerHeight;
      window.scrollTo({
        top: targetPosition,
        behavior: "smooth",
      });
    }
  }

  setActiveNav() {
    const sections = ["inicio", "servicios", "promociones", "reservas"];
    const scrollPosition = window.scrollY + 100;

    sections.forEach((sectionId) => {
      const section = document.getElementById(sectionId);
      if (section) {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;

        if (
          scrollPosition >= sectionTop &&
          scrollPosition < sectionTop + sectionHeight
        ) {
         
          this.navLinks.forEach((link) => link.classList.remove("active"));

         
          const activeLink = document.querySelector(`a[href="#${sectionId}"]`);
          if (activeLink && activeLink.classList.contains("nav-link")) {
            activeLink.classList.add("active");
          }
        }
      }
    });
  }

  initLogoEffect() {
    const logo = document.querySelector(".group");
    if (logo) {
      logo.addEventListener("mouseenter", function () {
        const logoElement = this.querySelector(".bg-gradient-to-br");
        if (logoElement) logoElement.classList.add("logo-glow");
      });

      logo.addEventListener("mouseleave", function () {
        const logoElement = this.querySelector(".bg-gradient-to-br");
        if (logoElement) logoElement.classList.remove("logo-glow");
      });
    }
  }
}


if (typeof module !== "undefined" && module.exports) {
  module.exports = Navigation;
}
