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
            <div class="g-recaptcha"
                  data-sitekey="6LcxyKkUAAAAAH67c2dmQDkHsE35tI-jeWWfcOJG"
                  data-callback="onSubmit"
                  data-size="invisible">
            </div>
            <button type="button" name="button"  class="btn btn-info mx-2" @click="validateRecaptcha">Validate Recaptcha</button>
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
  name: 'register',
  data(){
    return {
      username : '',
      password : '',
      password_confirmation: '',
      token: '',
    };
  },
  computed: mapGetters(['isAuthenticated']),
  methods : {
    ...mapActions(['authSignUp']),
    register(){
      this.authSignUp({
        "email":this.username,
        "password":this.password,
        "password_confirmation": this.password_confirmation,
        "token": this.token
      })
      .then(res =>{
        if(res=='registered'){
          this.$router.push({name:'login'});
        }
      });
    },
    validateRecaptcha(){
      window.grecaptcha.execute().then((token)=>{
        this.token = token;
        $(this.$refs.buttonForm).prop('disabled', false);
        this.$swal.fire('Recaptcha', 'Recaptcha was validated', 'success');
      });
    }
  },
  created(){
    if(this.isLogged){
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
