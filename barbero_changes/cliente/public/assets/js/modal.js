/**
 * Maneja todos los modales de la aplicación
 */
class Modal {
  constructor() {
    this.modals = new Map();
    this.init();
  }

  init() {
    this.initLocationModal();
    console.log("Modal: Initialized successfully");
  }

  initLocationModal() {
    const ubicacionBtn = document.getElementById("ubicacionBtn");
    const ubicacionModal = document.getElementById("ubicacionModal");
    const cerrarUbicacionModal = document.getElementById(
      "cerrarUbicacionModal"
    );

    if (!ubicacionBtn || !ubicacionModal) {
      console.warn("Modal: Location modal elements not found");
      return;
    }

    // Registrar modal
    this.modals.set("location", {
      trigger: ubicacionBtn,
      modal: ubicacionModal,
      closeBtn: cerrarUbicacionModal,
    });

    // abrir modal
    ubicacionBtn.addEventListener("click", (e) => {
      e.preventDefault();
      this.openModal("location");
    });

    // cerar modal 
    if (cerrarUbicacionModal) {
      cerrarUbicacionModal.addEventListener("click", () => {
        this.closeModal("location");
      });
    }

 
    ubicacionModal.addEventListener("click", (e) => {
      if (e.target === ubicacionModal) {
        this.closeModal("location");
      }
    });

    // Cerar modal with Escape key
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !ubicacionModal.classList.contains("hidden")) {
        this.closeModal("location");
      }
    });
  }

  openModal(modalName) {
    const modalData = this.modals.get(modalName);
    if (!modalData) {
      console.error(`Modal: Modal "${modalName}" not found`);
      return;
    }

    console.log(`Modal: Opening ${modalName} modal`);
    modalData.modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";

    // cerrar menu mobil
    const mobileMenu = document.getElementById("mobileMenu");
    if (mobileMenu && mobileMenu.classList.contains("show")) {
      mobileMenu.classList.remove("show");
      const hamburgerLines = document.querySelector(".hamburger-lines");
      if (hamburgerLines) hamburgerLines.classList.remove("active");
    }


    const modalContent = modalData.modal.querySelector(".modal-content");
    if (modalContent) {
      modalContent.classList.add("modal-content");
    }
  }

  closeModal(modalName) {
    const modalData = this.modals.get(modalName);
    if (!modalData) {
      console.error(`Modal: Modal "${modalName}" not found`);
      return;
    }

    console.log(`Modal: Closing ${modalName} modal`);
    modalData.modal.classList.add("hidden");
    document.body.style.overflow = "auto";
  }

  closeAllModals() {
    this.modals.forEach((modalData, modalName) => {
      this.closeModal(modalName);
    });
  }


  registerModal(name, triggerSelector, modalSelector, closeSelector = null) {
    const trigger = document.querySelector(triggerSelector);
    const modal = document.querySelector(modalSelector);
    const closeBtn = closeSelector
      ? document.querySelector(closeSelector)
      : null;

    if (!trigger || !modal) {
      console.warn(`Modal: Elements for "${name}" modal not found`);
      return false;
    }

    this.modals.set(name, {
      trigger,
      modal,
      closeBtn,
    });

  
    trigger.addEventListener("click", (e) => {
      e.preventDefault();
      this.openModal(name);
    });

    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        this.closeModal(name);
      });
    }

   
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        this.closeModal(name);
      }
    });

    console.log(`Modal: Registered "${name}" modal`);
    return true;
  }
}


if (typeof module !== "undefined" && module.exports) {
  module.exports = Modal;
}
