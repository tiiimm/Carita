import Vue from 'vue'
import Vuetify from 'vuetify'
import swal from 'sweetalert2'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css'
import '@fortawesome/fontawesome-free/css/all.css'
import VueProgressBar from 'vue-progressbar'
import Cloudinary from 'cloudinary-vue';

Vue.use(require('vue-moment'));
Vue.use(Cloudinary, {
  configuration: {
    cloudName: "tim0923"
  }
});


Vue.use(Vuetify)
Vue.use(VueProgressBar, {
    color: '#fabc3c',
    thickness: '7px',
    failedColor: 'red',
    height: '3px'
})
window.toast = toast;

window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000  
});

const opts = {
    theme: {
        themes: {
            light: {
                primary: '#6159E5',
                secondary: '#867EFF',
                accent: '#f55536',
            },
        }
    },
    icons: {
        iconfont: 'fa',
        iconfont: 'mdi',
    },
}

export default new Vuetify(opts)
