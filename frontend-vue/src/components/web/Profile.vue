<template>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2>Profile Data</h2>

      <form @submit="onSubmit">
        <div class="row">
          <div class="col-sm-12 col-md-6 form-group">
            <label>First Name</label>
            <input type="text" class="form-control" v-model="user.first_name">
            <span class="small text-danger" v-if="errors.first_name" v-for="error in errors.first_name" >{{error}}</span>
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" v-model="user.last_name">
            <span class="small text-danger" v-if="errors.last_name" v-for="error in errors.last_name" >{{error}}</span>
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Address</label>
            <input type="text" class="form-control" v-model="user.address">
            <span class="small text-danger" v-if="errors.address" v-for="error in errors.address" >{{error}}</span>
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>City</label>
            <input type="text" class="form-control" v-model="user.city">
            <span class="small text-danger" v-if="errors.city" v-for="error in errors.city" >{{error}}</span>
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Country</label>
            <input type="text" class="form-control" v-model="user.country">
            <span class="small text-danger" v-if="errors.country" v-for="error in errors.country" >{{error}}</span>
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Phone</label>
            <input type="text" class="form-control" v-model="user.phone">
            <span class="small text-danger" v-if="errors.phone" v-for="error in errors.phone" >{{error}}</span>
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Fax</label>
            <input type="text" class="form-control" v-model="user.fax">
            <span class="small text-danger" v-if="errors.fax" v-for="error in errors.fax" >{{error}}</span>
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
import {mapGetters,mapActions} from 'vuex';
export default {
  methods:{
    ...mapActions(['AddOrUpdateCustomer', 'fetchUser']),
    onSubmit(e){
      e.preventDefault();
      //copy user object
      var customer = {...this.user};
      //remove id from User since this will be a customer entity
      delete customer.id;
      //ad user_id for update customer entity in database.
      customer.user_id = this.user.id;
      //add customer id if exist to update the entity.
      if(this.user.customer_id) customer.id = this.user.customer_id;
      //send customer to validate.
      this.AddOrUpdateCustomer(customer).then((res)=>{
        //fetch user again to get all fields.
        if(res!='error') this.fetchUser();
      });
    }
  },
  computed:{
    ...mapGetters(['errors', 'user', 'getToken']),
  },
  created(){
    if(!this.getToken){
      this.$router.push({name:'home'});
    }
    //allways must have an user.
    if(typeof this.user.id === 'undefined') this.fetchUser();
  },
}
</script>

<style lang="css" scoped>
</style>
