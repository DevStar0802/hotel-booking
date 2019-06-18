<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Hotel Edit Details</h2>

        <form @submit="onSubmit">
          <div class="row">
            <div class="form-group col-sm-12 col-md-6">
              <label>Name</label>
              <input type="text" class="form-control" v-model="hotel.name" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Address</label>
              <input type="text" class="form-control" v-model="hotel.addres">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>City</label>
              <input type="text" class="form-control" v-model="hotel.city">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>State</label>
              <input type="text" class="form-control" v-model="hotel.state">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Country</label>
              <input type="text" class="form-control" v-model="hotel.country">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Zip Code</label>
              <input type="text" class="form-control" v-model="hotel.zip_code">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Phone Number</label>
              <input type="text" class="form-control" v-model="hotel.phone">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" v-model="hotel.email">
            </div>
            <div class="form-group col-sm-12 col-md-6" >
              <label>Current Image</label>
              <img :src="backend_endpoint+'/'+hotel.image" style="max-height:80px;" alt="" v-if="hotel.image">
              <img src="/images/no-image.png" alt="" style="max-height:80px;" v-if="!hotel.image">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label for="exampleFormControlFile1">Image</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" ref="image_m">
              <div class="" v-for="error in errors.image" v-if="errors.image">
                  <span class="small text-danger">{{error}}</span>
              </div>

            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {
  data(){
    return {
      backend_endpoint:process.env.VUE_APP_BE,
    }
  },
  methods:{
    ...mapActions(['fetchHotel', "updateHotel"]),
    onSubmit(e){
      e.preventDefault();
      delete this.hotel.image;
      if(this.$refs.image_m.value) {
        this.hotel.image = this.$refs.image_m.files[0];
      }
      this.updateHotel(this.hotel);
    }
  },
  computed: mapGetters(['hotel', 'errors']),
  created(){
    this.fetchHotel();
  }
}
</script>

<style lang="css" scoped>
</style>
