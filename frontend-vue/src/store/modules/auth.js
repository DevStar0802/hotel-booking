import axios from 'axios';
import Swal from 'sweetalert2';
import * as helpers from '@/helpers.js'

const state = {
  s_token :'',
  token: helpers.getCookie('user-token') || '',
  session:{},
  s_user:{}
};

const getters =  {
  isAuthenticated: state => !!state.token || (!!state.session && !!state.session.token) || false,
  getToken:state => state.s_token,
  user: state => state.s_user,
};

const actions = {
  async fetchUser({commit, getters}){
    try {
      var headers = { headers: {"Authorization" : `Bearer ${getters.getToken}`} }
      const response = await axios.get(process.env.VUE_APP_BE+'/api/auth/user', headers);
      if(response.data.errors) {
        commit('setErrors', response.data.errors);
        throw new Error("error trying to get user");
      }
      commit('setUser', response.data);
    } catch (e) {
      console.log(e.message);
      return "error";
    }
  },
  async authRequest({commit}, credentials){
    try {

      const response = await axios.post(process.env.VUE_APP_BE+'/api/auth/login', credentials);

      if(response.data.logged){
          commit('sessionAccepted', response.data.logged);
          commit('setToken', response.data.logged.access_token);
          commit('setErrors', []);
      } else if(response.data.errors) {
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      } else {
        throw new Error("something wrong")
      }
      return "logged";
    } catch (e) {
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
      return "error";
    }
  },
  async authSignUp({commit}, credentials){

    try {

      const response = await axios.post(process.env.VUE_APP_BE+'/api/auth/signup', credentials);

      if(response.data.registered){
          Swal.fire(
            'Good job!',
            'Account Created!',
            'success'
          );
          commit('setErrors', []);
      } else if(response.data.errors) {
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      } else {
        throw new Error("something wrong")
      }
      return "registered";
    } catch (e) {

      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
      return "error";
    }

  },
  async authLogOut({commit, getters}){
     var headers = { headers: {"Authorization" : `Bearer ${getters.getToken}`} }
    try {
      const response = await axios.get(process.env.VUE_APP_BE+'/api/auth/logout', headers);

      if(response.data.great){
          commit('cleanSession', response.data);
          commit('setToken', '');

      } else {
        throw new Error("something wrong")
      }
      return "great";
    } catch (e) {
      Swal.fire(
        'Error!',
        e.message,
        'error'
      );
      return "error";
    }
  },
  updateAuthStatus({commit}){
    if(helpers.getCookie('user-token') !='') commit('setToken', helpers.getCookie('user-token'));
  },
};

const mutations = {
  sessionAccepted: (state, session) => {
    if(session.access_token){

      state.session = session;
      helpers.setCookie('user-token', session.access_token, 7);
    }
  },
  cleanSession:(state, data) => {
    helpers.eraseCookie('user-token');
    state.session = {};
  },
  setToken:(state, token) =>state.s_token = token,
  setUser:(state,user) => state.s_user = user,
};

export default {
  state,
  getters,
  actions,
  mutations
}
