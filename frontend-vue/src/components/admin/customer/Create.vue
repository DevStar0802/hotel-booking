<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>
          <span v-if="id">Edit Customer Details</span>
          <span v-if="!id">Create Customer</span>
        </h2>
        <form @submit="onSubmit">
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>First Name</label>
              <input type="text" class="form-control" v-model="customer.first_name">
              <span class="small text-danger" v-if="errors.first_name" v-for="error in errors.first_name" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" v-model="customer.last_name">
              <span class="small text-danger" v-if="errors.last_name" v-for="error in errors.last_name" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Address</label>
              <input type="text" class="form-control" v-model="customer.address">
              <span class="small text-danger" v-if="errors.address" v-for="error in errors.address" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>City</label>
              <input type="text" class="form-control" v-model="customer.city">
              <span class="small text-danger" v-if="errors.city" v-for="error in errors.city" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Country</label>
              <input type="text" class="form-control" v-model="customer.country">
              <span class="small text-danger" v-if="errors.country" v-for="error in errors.country" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Phone</label>
              <input type="text" class="form-control" v-model="customer.phone">
              <span class="small text-danger" v-if="errors.phone" v-for="error in errors.phone" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Fax</label>
              <input type="text" class="form-control" v-model="customer.fax">
              <span class="small text-danger" v-if="errors.fax" v-for="error in errors.fax" >{{error}}</span>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Email</label>
              <input type="text" class="form-control" v-model="customer.email">
              <span class="small text-danger" v-if="errors.email" v-for="error in errors.email" >{{error}}</span>
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
import {mapGetters,mapActions, mapMutations} from 'vuex';
export default {
  data(){
    return {
      id:'',
    }
  },
  methods:{
    ...mapActions(['showCustomer', 'AddOrUpdateCustomer', 'showCustomer']),
    ...mapMutations(['cleanCustomer']),
    onSubmit(e){
      e.preventDefault();
      this.AddOrUpdateCustomer(this.customer).then(res => {
        //console.log(res);
        if(!this.id && res!='error') this.$router.push({ name: "customers"});
      });


    }
  },
  computed:{
    ...mapGetters(['customer', 'errors']),
  },
  created(){
    if(this.$route.params.id) {
      this.id = this.$route.params.id;
      this.showCustomer(this.id);
    } else {
      this.cleanCustomer();
    }
  },
}
</script>

<style lang="css" scoped>
</style>
