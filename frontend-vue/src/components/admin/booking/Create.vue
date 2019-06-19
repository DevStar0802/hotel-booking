<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Edit Booking Details</h2>
        <form @submit="onSubmit">
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>Room ID</label>
              <input type="text" class="form-control" v-model="booking.room_id">
              <span class="small text-danger" v-if="errors.room_id" v-for="error in errors.room_id" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Customer ID</label>
              <input type="text" class="form-control" v-model="booking.customer_id">
              <span class="small text-danger" v-if="errors.customer_id" v-for="error in errors.customer_id" >{{error}}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group" v-if="typeof booking.start_date !== 'undefined'">
              <label>Start Date</label>
              <datepicker v-model="booking.start_date" :use-utc="true"></datepicker>
              <span class="small text-danger" v-if="errors.start_date" v-for="error in errors.start_date" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group" v-if="typeof booking.end_date !== 'undefined'">
              <label>End Date</label>
              <datepicker v-model="booking.end_date" :use-utc="true" ></datepicker>
              <span class="small text-danger" v-if="errors.end_date" v-for="error in errors.end_date" >{{error}}</span>
            </div>
          </div>
          <div class="col-sm-12">
            <button type="submit" class="btn btn-success" name="button">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {mapGetters,mapActions} from 'vuex';
export default {
  data(){
    return {
      id:'',
    }
  },
  methods:{
    ...mapActions(['showBooking', 'AddOrUpdateBooking', 'showBooking']),
    onSubmit(e){
      e.preventDefault();
      //console.log(this.booking);
      this.AddOrUpdateBooking(this.booking);
    }
  },
  computed:{
    ...mapGetters(['booking', 'errors']),
  },
  created(){
    if(this.$route.params.id) {
      this.id = this.$route.params.id;
      this.showBooking(this.id);
    } else {
      this.$router.push({ name: "booking"});
    }
  },
  components: {
    datepicker: Datepicker
  },
}
</script>

<style lang="css" scoped>
</style>
