import Vue from 'vue'
import Vuex from 'vuex'
import hotel from './modules/hotel';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    hotel
  }
})
