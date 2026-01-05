// Import lodash if needed
import _ from 'lodash';
window._ = _;

// Import axios
import axios from 'axios';
window.axios = axios;

// Set default Axios headers
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import Pusher and Laravel Echo
import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

// Configure Laravel Echo with Pusher
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Optional: Listen to a test channel/event
// window.Echo.channel('test-channel')
//     .listen('TestEvent', (e) => {
//         console.log('Received event:', e);
//     });
