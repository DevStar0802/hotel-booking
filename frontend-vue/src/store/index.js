import Vue from 'vue'
import Vuex from 'vuex'
import boiler from './modules/boiler';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    //divided by ","
    boiler
  }
})
