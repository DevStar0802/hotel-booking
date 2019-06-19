import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

///jquery
const $ = require('jquery')
window.$ = $

////sweetalert2
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.prototype.$swal = Swal;

Vue.config.productionTip = false

//template
Vue.component('layout-menu', require('./components/layout/Menu.vue').default);
Vue.component('layout-footer', require('./components/layout/Footer.vue').default);
Vue.component('select-api', require('./components/layout/Select.vue').default);

Vue.component('hotel-details', require('./components/admin/hotel/Hotel.vue').default);

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
