<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Booking Form</h2>

        <form @submit="onSubmit">
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group" >
              <label>Start Date</label>
              <datepicker v-model="bookingForm.start_date" :use-utc="true"></datepicker>
              <span class="small text-danger" v-if="errors.start_date" v-for="error in errors.start_date" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>End Date</label>
              <datepicker v-model="bookingForm.end_date" :use-utc="true" ></datepicker>
              <span class="small text-danger" v-if="errors.end_date" v-for="error in errors.end_date" >{{error}}</span>
            </div>
          </div>
          <div class="row">
            <select-api event-send="roomTypeChange" :val="parseInt(bookingForm.room_type_id)" label="Room Type" route="/api/room-types">
              <span class="small text-danger" v-if="errors.room_type_id" v-for="error in errors.room_type_id" >{{error}}</span>
            </select-api>
          </div>
          <div class="row">
            <button type="submit" name="button" class="btn btn-success">Submit</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {mapGetters, mapMutations} from 'vuex';
export default {
  created(){
    this.$on('roomTypeChange', data=>{
      this.bookingForm.room_type_id = data;
    });
  },
  methods:{
    ...mapMutations(['setBookingForm']),
    onSubmit(e){
      e.preventDefault();
      this.setBookingForm(this.bookingForm);
      if(this.bookingForm.end_date && this.bookingForm.start_date){
        this.$router.push({name:'room-list'});
      } else {
        this.$swal.fire(
          'Info',
          "pleas fill, the form first",
          'info'
        );
      }

    }
  },
  computed:mapGetters(['errors', 'bookingForm']),
  components: {
    datepicker: Datepicker
  },
}
</script>

<style lang="css" scoped>
</style>
