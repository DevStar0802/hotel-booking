import axios from 'axios';
import Swal from 'sweetalert2';

const state = {
  s_hotel:'',
  s_errors:[]
};

const getters =  {
  hotel:(state) => state.s_hotel,
  errors:(state) => state.s_errors
};

const actions = {
  async fetchHotel({commit}){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/hotel');

    commit('fetchHotel', response.data);
  },
  async updateHotel({commit}, hotel){
    try {
      // form data for the image
      var formData = new FormData();
      for ( var key in hotel ) {
          formData.append(key, hotel[key]);
      }
      //in order to send a put request with files have to emulate to laravel.
      formData.append('_method', 'put');

      const response = await axios.post(process.env.VUE_APP_BE+'/api/hotel/update', formData, {headers: {
        'Content-Type': 'multipart/form-data'
      }});
      if(response.data.errors){
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      }
      commit('setErrors', []);
      commit('updateHotel', response.data);
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

  }
};

const mutations = {
  setErrors: (state,errors) => state.s_errors = errors,
  fetchHotel: (state,hotel) => state.s_hotel = hotel,
  updateHotel: (state,hotel) => state.s_hotel = hotel
};

export default {
  state,
  getters,
  actions,
  mutations
}
