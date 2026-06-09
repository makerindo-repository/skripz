window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.connector.pusher.connection.bind('connected', function() {
    console.log('Connected to Pusher');
});
window.Echo.channel('pengumuman')
    .listen('PengumumanBroadcast', (event) => {
        // Menampilkan pemberitahuan menggunakan SweetAlert
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 8000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "info",
            title: event.title,
            text: event.message,
          });

        // Menambahkan pengumuman baru ke elemen list-pengumuman
        const container = document.getElementById('list-pengumuman');
        const item = `
            <div class="list-group-item mb-2">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="fe fe-info fe-16 text-success"></span>
                    </div>
                    <div class="col">
                        <small><strong>${event.title}</strong></small>
                        <div class="my-0 text-muted small">${event.message}</div>
                    </div>
                    <div class="col-auto">
                        <small class="text-muted">${event.created_at}</small>
                    </div>
                </div>
            </div>`;

        // Menambahkan item baru di awal daftar
        container.insertAdjacentHTML('afterbegin', item);
    });


