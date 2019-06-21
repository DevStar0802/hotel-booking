<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h2>Reservation Form</h2>
        <booking-details :booking-form="bookingForm" />
        <form @submit="onSubmit">
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>First Name</label>
              <input type="text" class="form-control" v-model="user.first_name">
              <span class="small text-danger" v-if="errors['customer.first_name']" v-for="error in errors['customer.first_name']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" v-model="user.last_name">
              <span class="small text-danger" v-if="errors['customer.last_name']" v-for="error in errors['customer.last_name']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Address</label>
              <input type="text" class="form-control" v-model="user.address">
              <span class="small text-danger" v-if="errors['customer.address']" v-for="error in errors['customer.address']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>City</label>
              <input type="text" class="form-control" v-model="user.city">
              <span class="small text-danger" v-if="errors['customer.city']" v-for="error in errors['customer.city']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Country</label>
              <input type="text" class="form-control" v-model="user.country">
              <span class="small text-danger" v-if="errors['customer.country']" v-for="error in errors['customer.country']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Phone</label>
              <input type="text" class="form-control" v-model="user.phone">
              <span class="small text-danger" v-if="errors['customer.phone']" v-for="error in errors['customer.phone']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Fax</label>
              <input type="text" class="form-control" v-model="user.fax">
              <span class="small text-danger" v-if="errors['customer.fax']" v-for="error in errors['customer.fax']" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Email</label>
              <input type="text" class="form-control" :value="user.email" disabled>
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
import {mapGetters, mapActions, mapMutations} from 'vuex';
export default {
  data(){
    return {
      customer:{}
    }

  },
  computed: mapGetters(['bookingForm', 'errors', 'user', 'getToken']),
  methods:{
    ...mapActions(['fetchUser', 'addBooking']),
    ...mapMutations(['setBookingForm']),
    onSubmit(e){
      e.preventDefault();
      this.bookingForm.customer = this.user;
      this.addBooking(this.bookingForm);
    }
  },
  created(){
    if(!this.getToken || !this.bookingForm || !this.bookingForm.room){
      this.$router.push({name:'home'});
    }
    //allways must have an user.
    if(typeof this.user.id === 'undefined') this.fetchUser();
  }
}
</script>

<style lang="css" scoped>
</style>
