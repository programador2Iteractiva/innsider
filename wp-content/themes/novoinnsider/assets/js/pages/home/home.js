import $ from 'jquery';
import Swiper from "swiper/bundle";
import 'bootstrap/dist/js/bootstrap.min';
import AOS from 'aos';

document.addEventListener("DOMContentLoaded", function () {

  /* Codigo para el carrosel del banner inicial */

  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  AOS.init({
    duration: 1000,
    once: true,
  });

  var checkCookies = document.getElementById('open-cookie-settings');

  checkCookies.addEventListener('click', function(){
    CookieYes.openSettings();
  })

});

