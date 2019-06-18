<template>
  <div>
    <layout-menu/>
    <div class="container">
        <main>
          <router-view/>
        </main>
    </div>
    <layout-footer/>
  </div>

</template>
<script>
  import 'bootstrap'; import 'bootstrap/dist/css/bootstrap.min.css';
  export default {
  }
</script>
<style lang="scss">
  @import "./styles/global.scss";
</style>
