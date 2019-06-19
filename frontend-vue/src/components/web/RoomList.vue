<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Room List</h2>
        <booking-details :booking-form="bookingForm" />
        <div class="row my-2 room-list-item" v-for="room in rooms" :key="room.id" @click="selectItem(room)">
          <div class="col-sm-3" >
            <img :src="backend_endpoint+'/'+room.image" style="max-height:80px;" alt="" v-if="room.image && room.image != '/images/no-room.png'">
            <img src="/images/no-image.png" alt="" style="max-height:80px;" v-if="!room.image">
            <img src="/images/no-image.png" alt="" style="max-height:80px;" v-if="room.image == '/images/no-room.png'">
          </div>
          <div class="col-sm-9">
            <b>Room Name:</b> {{room.name}}&nbsp;
            <b>Room Type:</b> {{room.type.name}}<br>
            <b>Room Capacity:</b> {{room.capacity.name}}&nbsp;
            <b>Total Price:</b>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
import {mapGetters, mapActions, mapMutations} from 'vuex';

export default {
  data(){
    return {
        backend_endpoint: process.env.VUE_APP_BE,
    }
  },
  methods:{
    ...mapActions(['fetchRooms']),
    ...mapMutations(['setBookingForm']),
    selectItem(room){
      this.bookingForm.room = room;
      this.setBookingForm(this.bookingForm);
      this.$router.push({name:'reservation-page'});
    }
  },
  computed: mapGetters(['rooms', 'bookingForm']),
  created(){
    if(!this.bookingForm || !this.bookingForm.start_date || !this.bookingForm.end_date){
      this.$router.push({name: 'home'});
    } else {
      var params = {};
      if(this.bookingForm && this.bookingForm.room_type_id) params.room_type_id = this.bookingForm.room_type_id;
      this.fetchRooms(params);
    }
  }
}
</script>

<style lang="css" scoped>
  .room-list-item{
    border-radius: 5px;
    border: 1px solid #000;
    cursor:pointer;
  }
  .room-list-item:hover{
    background-color: #dae3f2;
  }
</style>
