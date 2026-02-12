import Alpine from 'alpinejs'
import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

// Configure Swiper to use Navigation
Swiper.use([Navigation]);

window.Alpine = Alpine
window.Swiper = Swiper;

Alpine.start()
