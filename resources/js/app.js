import $ from 'jquery';
window.$ = $;
window.jQuery = $;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
import 'magnific-popup';
// import 'magnific-popup/dist/magnific-popup.min.css';

import './bootstrap';
import Alpine from 'alpinejs';
import './ajax';

window.Alpine = Alpine;

Alpine.start();
