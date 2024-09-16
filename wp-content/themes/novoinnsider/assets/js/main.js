import $ from 'jquery';
import Swal from "sweetalert2";
import Swiper from 'swiper/bundle';
import 'bootstrap/dist/js/bootstrap.min';
import '@fortawesome/fontawesome-free/js/all';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import Alpine from 'alpinejs';


window.Swal = Swal;
window.$ = $;
window.Swiper = Swiper;
window.Alpine = Alpine;

Alpine.start();

/* Components */

import './pages/pages'
import './elements/elements'