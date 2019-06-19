import axios from 'axios';
import Swal from 'sweetalert2';

const state = {
  s_prices:[],
  s_price : '',
};

const getters =  {
  prices: state=>state.s_prices,
  price: state=>state.s_price,
};

const actions = {
  async fetchPrices({commit}){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/prices');
    commit('setPrices', response.data);
  },
  async showPrice({commit}, id){
    const response = await axios.get(process.env.VUE_APP_BE+`/api/prices/${id}`);
    commit('setPrice', response.data);
  },
  async AddOrUpdatePrice({commit}, price){
    try {
      if(price.id && price.id>0){
          price['_method'] = 'put';
          var route = '/api/prices/'+price.id.toString();
      } else var route = '/api/prices';
      const response = await axios.post(process.env.VUE_APP_BE+route, price);
      console.log(response.data);
      if(response.data.errors){
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      }
      commit('setErrors', []);
      commit('setPrice', response.data);

      Swal.fire(
        'Good job!',
        'Price updated!',
        'success'
      );
    } catch (e) {
      console.log(e);
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
      return "error";
    }
  },
  async deletePrice({commit}, id){
    try {
      const response = await axios.delete(process.env.VUE_APP_BE+`/api/prices/${id}`);
      if(response.data.exception && response.data.exception.includes("Integrity constraint violation")){
        throw new Error("can't delete assigned item");
      }
      Swal.fire(
        'Deleted!',
        'Your Item has been deleted.',
        'success'
      );
      commit('deletePrice', id);
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
  setPrices:(state,prices)=>state.s_prices = prices,
  setPrice:(state,price)=>state.s_price = price,
  deletePrice: (state, id) => state.s_prices = state.s_prices.filter(item=> item.id !== id),
  cleanPrice:(state) => state.s_price = {
    name:'',
    price:0,
    room_type_id:0,
    room_capacity_id:0,
    day:'',
    start_date:'',
    end_date:''
  },
};

export default {
  state,
  getters,
  actions,
  mutations
}
