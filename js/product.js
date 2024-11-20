var swiper = new Swiper(".slide-container", {
  slidesPerView: 4,
  spaceBetween: 20,
  slidesPerGroup: 4, // Corrected to slidesPerGroup
  loop: true,
  effect: "fade", // Added fade effect
  grabCursor: true, // Corrected to true without quotes
  
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
    0: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1000: {
      slidesPerView: 4,
    },
  },
});
