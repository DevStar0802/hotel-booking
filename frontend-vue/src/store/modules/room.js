import axios from 'axios';
import Swal from 'sweetalert2';

const state = {
  s_rooms : [],
  s_room:''
};

const getters =  {
  rooms: state => state.s_rooms,
  room: state => state.s_room
};

const actions = {
  async fetchRooms({commit}){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/rooms');
    commit('setRooms', response.data);
  },
  async showRoom({commit}, id){
    const response = await axios.get(process.env.VUE_APP_BE+`/api/rooms/${id}`);
    commit('setRoom', response.data);
  },
  async AddOrUpdateRoom({commit}, room){
    try {
      // form data for the image
      var formData = new FormData();
      for ( var key in room ) {
          formData.append(key, room[key]);
      }
      //in order to send a put request with files have to emulate to laravel.
      if(room.id && room.id>0){
          formData.append('_method', 'put');
          var route = '/api/rooms/'+room.id.toString();
      } else var route = '/api/rooms';

      const response = await axios.post(process.env.VUE_APP_BE+route, formData, {headers: {
        'Content-Type': 'multipart/form-data'
      }});
      if(response.data.errors){
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      }
      commit('setErrors', []);
      commit('setRoom', response.data);
      Swal.fire(
        'Good job!',
        'Hotel updated!',
        'success'
      );
    } catch (e) {
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );

    }
  },
  async deleteRoom({commit}, id){
    try {
      const response = await axios.delete(process.env.VUE_APP_BE+`/api/rooms/${id}`);
      if(response.data.exception && response.data.exception.includes("Integrity constraint violation")){
        throw new Error("can't delete assigned item");
      }
      Swal.fire(
        'Deleted!',
        'Your Item has been deleted.',
        'success'
      );
      commit('deleteRoom', id);
    } catch (e) {
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
    }

  },
};

const mutations = {
  setRooms:(state,rooms) => state.s_rooms = rooms,
  setRoom:(state,room)=>state.s_room = room,
  deleteRoom: (state, id) => state.s_rooms = state.s_rooms.filter(item=> item.id !== id),
  cleanRoom:(state) => state.s_room = {
    name: "",
    room_type_id: 0,
    room_capacity_id: 0,
    image: "",
  },
};

export default {
  state,
  getters,
  actions,
  mutations
}
