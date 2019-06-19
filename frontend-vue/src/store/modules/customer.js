import axios from 'axios';
import Swal from 'sweetalert2';

const state = {
  s_customers:[],
  s_customer : '',
};

const getters =  {
  customers: state=>state.s_customers,
  customer: state=>state.s_customer,
};

const actions = {
  async fetchCustomers({commit}){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/customers');
    commit('setCustomers', response.data);
  },
  async showCustomer({commit}, id){
    const response = await axios.get(process.env.VUE_APP_BE+`/api/customers/${id}`);
    commit('setCustomer', response.data);
  },
  async AddOrUpdateCustomer({commit}, customer){
    try {
      if(customer.id && customer.id>0){
          customer['_method'] = 'put';
          var route = '/api/customers/'+customer.id.toString();
      } else var route = '/api/customers';
      const response = await axios.post(process.env.VUE_APP_BE+route, customer);
      //console.log(response.data);
      if(response.data.errors){
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      }
      commit('setErrors', []);
      commit('setCustomer', response.data);

      Swal.fire(
        'Good job!',
        'Customer updated!',
        'success'
      );
    } catch (e) {
      //console.log(e);
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
      return "error";
    }
  },
  async deleteCustomer({commit}, id){
    try {
      const response = await axios.delete(process.env.VUE_APP_BE+`/api/customers/${id}`);
      if(response.data.exception && response.data.exception.includes("Integrity constraint violation")){
        throw new Error("can't delete assigned item");
      }
      Swal.fire(
        'Deleted!',
        'Your Item has been deleted.',
        'success'
      );
      commit('deleteCustomer', id);
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
  setCustomers:(state,customers)=>state.s_customers = customers,
  setCustomer:(state,customer)=>state.s_customer = customer,
  deleteCustomer: (state, id) => state.s_customers = state.s_customers.filter(item=> item.id !== id),
  cleanCustomer:(state) => state.s_customer = {
    name:'',
    customer:0,
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
