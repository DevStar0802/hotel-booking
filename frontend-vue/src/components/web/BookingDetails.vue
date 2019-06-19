<template lang="html">
  <div class="">
    <p>
      <span v-if="bookingForm.start_date"><b>Start Date: </b>{{changeDate(bookingForm.start_date)}}</span>
      &nbsp;
      <span v-if="bookingForm.end_date"><b>End Date: </b>{{changeDate(bookingForm.end_date)}}</span>&nbsp;
      <span><b>Total Nights: </b>{{nights}}</span>&nbsp;<br>
      <span v-if="bookingForm.room && bookingForm.room.name"><b>Room Name:</b> {{bookingForm.room.name}}&nbsp;</span>
      <span v-if="bookingForm.room && bookingForm.room.type.name"><b>Room Type:</b> {{bookingForm.room.type.name}}&nbsp;</span>
      <span v-if="bookingForm.room && bookingForm.room.capacity.name"><b>Room Capacity:</b> {{bookingForm.room.capacity.name}}&nbsp;</span>



    </p>
  </div>
</template>

<script>
import * as helpers from '@/helpers.js';
export default {
  props:{
    bookingForm:{}
  },
  data(){
    return {
      nights: 0,
    }
  },
  methods:{
    changeDate(date){
      return helpers.formatDate(date);
    },
  },
  created(){
    if(this.bookingForm && this.bookingForm.start_date && this.bookingForm.end_date){
      this.nights = helpers.diffDates(this.bookingForm.start_date, this.bookingForm.end_date);
    }
  }
}
</script>

<style lang="css" scoped>
</style>
