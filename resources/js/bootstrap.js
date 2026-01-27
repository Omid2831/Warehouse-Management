/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel backend. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF-TOKEN" cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';