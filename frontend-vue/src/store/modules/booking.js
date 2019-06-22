import axios from 'axios';
import * as helpers from '@/helpers.js'
import Swal from 'sweetalert2';

const state = {
  s_bookings:[],
  s_booking : '',
  s_booking_form:{}
};

const getters =  {
  bookings: state=>state.s_bookings,
  booking: state=>state.s_booking,
  bookingForm:state=>state.s_booking_form
};

const actions = {
  async fetchBookings({commit}, params){
    const response = await axios.get(process.env.VUE_APP_BE+'/api/bookings', {params});
    commit('setBookings', response.data);
  },
  async showBooking({commit}, id){
    const response = await axios.get(process.env.VUE_APP_BE+`/api/bookings/${id}`);
    commit('setBooking', response.data);
  },
  async addBooking({commit}, booking){
    try {
      //console.log(booking.start_date);
      booking.start_date = helpers.formatDate(booking.start_date);
      booking.end_date = helpers.formatDate(booking.end_date);

//console.log(booking);
      const response = await axios.post(process.env.VUE_APP_BE+'/api/add-booking', booking);
      //console.log(response);
      if(response.data.errors){
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      }
      commit('setErrors', []);
      Swal.fire(
        'Good job!',
        'Booking created!',
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
  async AddOrUpdateBooking({commit}, booking){
    try {
      if(booking.id && booking.id>0){
          booking['_method'] = 'put';
          var route = '/api/bookings/'+booking.id.toString();
      } else throw new Error("can't save new Item");;
      //console.log(booking.start_date);
      booking.start_date = helpers.formatDate(booking.start_date);
      booking.end_date = helpers.formatDate(booking.end_date);

      const response = await axios.post(process.env.VUE_APP_BE+route, booking);
      if(response.data.errors){
        commit('setErrors', response.data.errors);
        throw new Error("some errors in form");
      }
      commit('setErrors', []);
      commit('setBooking', response.data);

      Swal.fire(
        'Good job!',
        'Booking updated!',
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
  async deleteBooking({commit}, id){
    try {
      const response = await axios.delete(process.env.VUE_APP_BE+`/api/bookings/${id}`);
      if(response.data.exception && response.data.exception.includes("Integrity constraint violation")){
        throw new Error("can't delete assigned item");
      }
      Swal.fire(
        'Deleted!',
        'Your Item has been deleted.',
        'success'
      );
      commit('deleteBooking', id);
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
  setBookings:(state,bookings)=>state.s_bookings = bookings,
  setBooking:(state,booking)=>state.s_booking = booking,
  setBookingForm:(state,bookingForm)=> state.s_booking_form = bookingForm,
  deleteBooking: (state, id) => state.s_bookings = state.s_bookings.filter(item=> item.id !== id),
};

export default {
  state,
  getters,
  actions,
  mutations
}
