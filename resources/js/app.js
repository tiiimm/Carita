require('./bootstrap');

window.Vue = require('vue');

import vuetify from './plugins/vuetify.js'
import router from './plugins/router.js'

const app = new Vue({
    vuetify,
    router,
}).$mount('#app')

axios.interceptors.request.use(function (config) {
    let authToken = localStorage.getItem('token') || ''
    if (authToken) {
        config.headers['Authorization'] = `Bearer ${authToken}`
    }   
    return config;
}, function (error) {
    return Promise.reject(error);
});