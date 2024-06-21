import $ from 'jquery';
import Swiper from "swiper/bundle";

document.addEventListener("DOMContentLoaded", function () {

    /* Codigo para el carrosel del banner inicial */

      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

});