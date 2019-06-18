import axios from 'axios';
import Swal from 'sweetalert2';

const state = {
  s_room_capacity :[]
};

const getters =  {
  room_capacity: state=>state.s_room_capacity
};

const actions = {
  async fetchCapacities({commit}){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/room-capacities');

    commit('setCapacities', response.data);
  },
  async addCapacity({commit}, item){
    const response = await axios.post(process.env.VUE_APP_BE+'/api/room-capacities', item);

    commit('addCapacity', response.data);
  },
  async deleteCapacity({commit}, id){
    try {
      const response = await axios.delete(process.env.VUE_APP_BE+`/api/room-capacities/${id}`);
      if(response.data.exception && response.data.exception.includes("Integrity constraint violation")){
        throw new Error("can't delete assigned item");
      }
      Swal.fire(
        'Deleted!',
        'Your Item has been deleted.',
        'success'
      );
      commit('deleteCapacity', id);
    } catch (e) {
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
    }

  },
  async updateCapacity({commit}, item){
    const response = await axios.put(process.env.VUE_APP_BE+`/api/room-capacities/${item.id}`, item);
    //console.log(response.data);
    commit('updateCapacity', response.data);
  }
};

const mutations = {
  setCapacities:(state, types) => state.s_room_capacity = types,
  addCapacity:(state,type) => state.s_room_capacity.unshift(type),
  deleteCapacity: (state, id) => state.s_room_capacity = state.s_room_capacity.filter(item=> item.id !== id),
  updateCapacity:(state, type) => {
    const index = state.s_room_capacity.findIndex(item => item.id===type.id);
    if(index !== -1){
      state.s_room_capacity.splice(index,1, type);
    }
  }
};

export default {
  state,
  getters,
  actions,
  mutations
}
