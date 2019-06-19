<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>
          <span v-if="id">Edit Price Details</span>
          <span v-if="!id">Create Price</span>
        </h2>
        <form @submit="onSubmit">
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="price.name">
              <span class="small text-danger" v-if="errors.name" v-for="error in errors.name" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Price</label>
              <input type="text" class="form-control" v-model="price.price">
              <span class="small text-danger" v-if="errors.price" v-for="error in errors.price" >{{error}}</span>
            </div>
          </div>
          <div class="row">
            <select-api event-send="roomTypeChange" :val="parseInt(price.room_type_id)" label="Room Type" route="/api/room-types">
              <span class="small text-danger" v-if="errors.room_type_id" v-for="error in errors.room_type_id" >{{error}}</span>
            </select-api>
            <select-api event-send="roomCapacityChange" :val="parseInt(price.room_capacity_id)" label="Room Capacity" route="/api/room-capacities">
              <span class="small text-danger" v-if="errors.room_capacity_id" v-for="error in errors.room_capacity_id" >{{error}}</span>
            </select-api>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>Day of week</label>
              <select class="form-control" name="" v-model="price.day">
                <option v-for="day in days">{{day}}</option>
              </select>
              <span class="small text-danger" v-if="errors.day" v-for="error in errors.day" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="dinamic_price">
              <label class="form-check-label" for="exampleCheck1">Dinamic Price</label>
            </div>
          </div>
          <div class="row" v-if="dinamic_price">
            <div class="col-sm-12 col-md-6 form-group" v-if="typeof price.start_date !== 'undefined'">
              <label>Start Date</label>
              <datetime v-model="price.start_date"></datetime>
              <span class="small text-danger" v-if="errors.start_date" v-for="error in errors.start_date" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group" v-if="typeof price.end_date !== 'undefined'">
              <label>End Date</label>
              <datetime v-model="price.end_date"></datetime>
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
import { Datetime } from 'vue-datetime';
import { DateTime } from "luxon";
import {mapGetters,mapActions, mapMutations} from 'vuex';
export default {
  data(){
    return {
      id:'',
      bindProp:0,
      dinamic_price:false,
      backend_endpoint:process.env.VUE_APP_BE,
      days:['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday','sunday',  'all'],
    }
  },
  methods:{
    ...mapActions(['showPrice', 'AddOrUpdatePrice', 'showPrice']),
    ...mapMutations(['cleanPrice']),
    onSubmit(e){
      e.preventDefault();
      if(this.dinamic_price){
        this.price.start_date = this.price.start_date.replace('T00:00:00.000Z', '');
        this.price.end_date = this.price.end_date.replace('T00:00:00.000Z', '');
      } else {
        delete this.price.start_date;
        delete this.price.end_date;
      }
      //console.log(this.price);
      this.AddOrUpdatePrice(this.price).then(res => {
        //console.log(res);
        if(!this.id && res!='error') this.$router.push({ name: "prices"});
      });


    }
  },
  computed:{
    ...mapGetters(['price', 'errors']),
  },
  created(){
    if(this.$route.params.id) {
      this.id = this.$route.params.id;
      this.showPrice(this.id).then(()=>{
        if(this.price.start_date || this.price.end_date){
          this.dinamic_price= true;
        }
      });
    } else {
      this.cleanPrice();
      this.dinamic_price=false;
    }
    this.$on('roomTypeChange', data=>{
      this.price.room_type_id = data;
    });
    this.$on('roomCapacityChange', data=>{
      this.price.room_capacity_id = data;
    });
  },
  components: {
    datetime: Datetime
  },
  beforeDestroy(){
    this.dinamic_price=false;
    this.cleanPrice();
  }

}
</script>

<style lang="css" scoped>
</style>
