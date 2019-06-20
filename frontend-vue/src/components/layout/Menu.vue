<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <router-link tag="li" to="/" class="nav-item">
        <a class="nav-link">Home</a>
      </router-link>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <router-link to="/admin/rooms" class="dropdown-item">Room Manager</router-link>
          <router-link to="/admin/room-types" class="dropdown-item">Room Type Manager</router-link>
          <router-link to="/admin/room-capacities" class="dropdown-item">Room Capacity Manager</router-link>
          <div class="dropdown-divider"></div>
          <router-link to="/admin/booking" class="dropdown-item">Booking Manager</router-link>
          <router-link to="/admin/customers" class="dropdown-item">Customer Manager</router-link>
          <router-link to="/admin/prices" class="dropdown-item">Price List Manager</router-link>
          <div class="dropdown-divider"></div>
          <router-link to="/admin/hotel-details" class="dropdown-item">Hotel Details</router-link>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto" v-if="!getToken">
      <router-link tag="li" :to="{name: 'login'}" class="nav-item">
        <a class="nav-link">Login</a>
      </router-link>
      <router-link tag="li" :to="{name: 'register'}" class="nav-item">
        <a class="nav-link">Register</a>
      </router-link>
    </ul>
    <ul class="navbar-nav ml-auto" v-if="getToken">
      <li class="nav-item">
        <a href="#" class="nav-link" @click="authLogOut">Logout</a>
      </li>
    </ul>
  </div>
</nav>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
export default {
  computed: mapGetters(['getToken']),
  methods:{
    ...mapActions(['authLogOut', 'updateAuthStatus']),
  },
  created(){
    this.updateAuthStatus();
  }
}
</script>

<style lang="css" scoped>
</style>
