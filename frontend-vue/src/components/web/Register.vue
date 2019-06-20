<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h1>Sign Up</h1>
        <form class="login" @submit.prevent="register()">
          <div class="col-sm-12 form-group">
            <label>Email</label>
            <input required v-model="username" class="form-control" type="text" placeholder="email@example.com"/>
          </div>
          <div class="col-sm-12 form-group">
            <label>Password</label>
            <input required v-model="password" class="form-control" type="password" placeholder="Password"/>
          </div>
          <div class="col-sm-12 form-group">
            <label>Password Confirm</label>
            <input id="password-confirm" type="password"  v-model="password_confirmation" name="password_confirmation" required="required" autocomplete="new-password" class="form-control">
          </div>
          <div class="col-sm-12">
            <button type="submit" class="btn btn-success" name="button">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';

export default {
  name: 'register',
  data(){
    return {
      username : '',
      password : '',
      password_confirmation: ''
    };
  },
  computed: mapGetters(['isAuthenticated']),
  methods : {
    ...mapActions(['authSignUp']),
    register(){
      this.authSignUp({"email":this.username, "password":this.password, "password_confirmation": this.password_confirmation})
      .then(res =>{
        if(res=='registered'){
          this.$router.push({name:'login'});
        }
      });
    }
  },
  created(){
    if(this.isLogged){
      this.$router.push({name:'home'});
    }
  }
}
</script>

<style lang="css" scoped>
</style>
