<template>
  <div class="col-sm-3">
    <span><b>Night: </b>{{day}} </span>
    <span><b>Price: </b><span class="text-success">{{price.price}}</span></span>
  </div>
</template>

<script>
import axios from 'axios';
import {mapGetters} from 'vuex';
export default {
  data(){
    return {
      price:{}
    }
  },
  props:{
    day:String,
    room:Object
  },
  methods:{
    getPrice(){
      axios.get(process.env.VUE_APP_BE+'/api/price-filtered', {params:{
        room_type_id: this.bookingForm.room_type_id,
        room_capacity_id: this.$props.room.room_capacity_id,
        date: this.$props.day
      }})
      .then(response => {
        if(typeof this.room.total_price === 'undefined') this.room.total_price = 0;
        this.price = response.data;
        this.room.total_price = this.room.total_price + this.price.price;
        this.$parent.$emit('updateTotalPrice');
      })
      .catch(e => {

      });
    }
  },
  computed: mapGetters(['bookingForm']),
  created(){
    this.getPrice();
  }
}
</script>

<style lang="css" scoped>
</style>
