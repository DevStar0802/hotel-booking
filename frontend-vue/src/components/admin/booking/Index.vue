<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Booking Manager</h2>
        <div class="row my-2">
        </div>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Room ID</td>
                <td>Date Start</td>
                <td>Date End</td>
                <td>Customer ID</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="booking in bookings" :key="booking.id">
                <td>{{booking.id}}</td>
                <td>{{booking.room_id}}</td>
                <td>{{booking.start_date}}</td>
                <td>{{booking.end_date}}</td>
                <td>{{booking.customer_id}}</td>
                <td>
                  <router-link :to="{name: 'booking-edit', params:{id:booking.id}}" class="btn btn-info mx-2">Edit</router-link>
                  <button type="button" @click="removeItem(booking.id)" class="btn btn-danger mx-2">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {
  data(){
    return {
    }
  },
  methods:{
    ...mapActions(['fetchBookings', 'deleteBooking']),
    removeItem(id){
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.deleteBooking(id);
        }
      })
    },
  },
  computed: mapGetters(['bookings']),
  created(){
    this.fetchBookings();
  }
}
</script>
