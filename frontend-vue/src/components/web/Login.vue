<template lang="html">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h1>Sign in</h1>
        <br>
        <h4>Don't Have an account? <router-link :to="{ name: 'register'}">Sing up</router-link></h4>
        <br>
        <form class="login" @submit.prevent="login()">
          <div class="col-sm-12 form-group">
            <label>Email</label>
            <input required v-model="username" class="form-control" type="text" placeholder="email@example.com"/>
          </div>
          <div class="col-sm-12 form-group">
            <label>Password</label>
            <input required v-model="password" class="form-control" type="password" placeholder="Password"/>
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
  name: 'login',
  data(){
    return {
      username : '',
      password : ''
    };
  },
  computed: mapGetters(['isAuthenticated']),
  methods : {
    ...mapActions(['authRequest']),
    login(){
      this.authRequest({"email":this.username, "password":this.password, "remember_me": true})
      .then(res => {
        if(res=='logged'){
          this.$router.push({name:'home'});
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
