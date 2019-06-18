import axios from 'axios';
import Swal from 'sweetalert2';

const state = {
  s_room_types :[]
};

const getters =  {
  room_types: state=>state.s_room_types
};

const actions = {
  async fetchTypes({commit}){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/room-types');

    commit('setTypes', response.data);
  },
  async addType({commit}, item){
    const response = await axios.post(process.env.VUE_APP_BE+'/api/room-types', item);

    commit('addType', response.data);
  },
  async deleteType({commit}, id){
    try {
      const response = await axios.delete(process.env.VUE_APP_BE+`/api/room-types/${id}`);
      if(response.data.exception && response.data.exception.includes("Integrity constraint violation")){
        throw new Error("can't delete assigned item");
      }
      Swal.fire(
        'Deleted!',
        'Your Item has been deleted.',
        'success'
      );
      commit('deleteType', id);
    } catch (e) {
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
    }

  },
  async updateType({commit}, item){
    const response = await axios.put(process.env.VUE_APP_BE+`/api/room-types/${item.id}`, item);
    //console.log(response.data);
    commit('updateType', response.data);
  }
};

const mutations = {
  setTypes:(state, types) => state.s_room_types = types,
  addType:(state,type) => state.s_room_types.unshift(type),
  deleteType: (state, id) => state.s_room_types = state.s_room_types.filter(item=> item.id !== id),
  updateType:(state, type) => {
    const index = state.s_room_types.findIndex(item => item.id===type.id);
    if(index !== -1){
      state.s_room_types.splice(index,1, type);
    }
  }
};

export default {
  state,
  getters,
  actions,
  mutations
}
