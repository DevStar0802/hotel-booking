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
            <span class="small text-danger" v-for="error in errors.email" v-if="errors.email">{{error}}</span>
          </div>
          <div class="col-sm-12 form-group">
            <label>Password</label>
            <input required v-model="password" class="form-control" type="password" placeholder="Password"/>
            <span class="small text-danger" v-for="error in errors.password" v-if="errors.password">{{error}}</span>
          </div>

          <div class="col-sm-12">
            <div class="g-recaptcha"
                  data-sitekey="6LcxyKkUAAAAAH67c2dmQDkHsE35tI-jeWWfcOJG"
                  data-size="invisible">
            </div>
            <span class="small text-danger" v-for="error in errors.recaptcha" v-if="errors.recaptcha">{{error}}</span>
            <button type="button" name="button"  class="btn btn-info mx-2" @click="validateRecaptcha" ref="buttonRecaptcha">Validate Recaptcha</button>
            <button type="submit" class="btn btn-success  mx-2" name="button" disabled ref="buttonForm">Submit</button>
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
      password : '',
      token: '',
    };
  },
  computed: mapGetters(['isAuthenticated', 'errors', 'getToken']),
  methods : {
    ...mapActions(['authRequest']),
    login(){
      this.authRequest({"email":this.username, "password":this.password, "remember_me": true, "token": this.token})
      .then(res => {
        if(res=='logged'){
          this.$router.push({name:'home'});
        }
      });
    },
    validateRecaptcha(){
      window.grecaptcha.execute().then((token)=>{
        this.token = token;
        $(this.$refs.buttonForm).prop('disabled', false);
        $(this.$refs.buttonRecaptcha).prop('disabled', true);
        this.$swal.fire('Recaptcha', 'Recaptcha was validated', 'success');
      });
    }
  },
  created(){
    if(this.getToken){
      this.$router.push({name:'home'});
    }

  },
  mounted(){
    window.grecaptcha.ready(() => {
      window.grecaptcha.render({sitekey:'6LcxyKkUAAAAAH67c2dmQDkHsE35tI-jeWWfcOJG'});
    });
  }
}
</script>

<style lang="css" scoped>

</style>
