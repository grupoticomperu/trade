import axios from 'axios';
import Swal from 'sweetalert2'; /* llamando a sweet alert 2 */
window.axios = axios;
window.swal = Swal; 
//const Swal = require('sweetalert2')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
