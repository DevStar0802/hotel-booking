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
          <router-link to="/admin/room-types" class="dropdown-item">Room Type Manager</router-link>
          <router-link to="/admin/room-capacities" class="dropdown-item">Room Capacity Manager</router-link>
          <div class="dropdown-divider"></div>
          <router-link to="/admin/hotel-details" class="dropdown-item">Hotel Details</router-link>
        </div>
      </li>
    </ul>
  </div>
</nav>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
</style>
