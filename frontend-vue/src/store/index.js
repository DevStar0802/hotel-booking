import Vue from 'vue'
import Vuex from 'vuex'
import hotel from './modules/hotel';
import room from './modules/room';
import price from './modules/price';
import roomType from './modules/room-type';
import roomCapacity from './modules/room-capacity';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    hotel, roomType, roomCapacity, room, price
  }
})
