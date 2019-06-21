<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Price List Manager</h2>
        <div class="row my-2">
          <div class="col-sm-6">
              <router-link :to="{name: 'prices-create'}" class="btn btn-success mx-2">Create</router-link>
          </div>
        </div>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Name </td>
                <td>Price</td>
                <td>Actions</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="price in prices" :key="price.id">
                <td>{{price.id}}</td>
                <td>{{price.name}} <span class="badge badge-secondary" v-if="price.dynamic">Dynamic</span></td>
                <td>${{new Intl.NumberFormat("en-US").format(price.price)}}</td>
                <td>
                  <router-link :to="{name: 'prices-edit', params:{id:price.id}}" class="btn btn-info mx-2">Edit</router-link>
                  <button type="button" @click="removeItem(price.id)" class="btn btn-danger mx-2">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {
  data(){
    return {
    }
  },
  methods:{
    ...mapActions(['fetchPrices', 'deletePrice']),
    removeItem(id){
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.deletePrice(id);
        }
      })
    },
  },
  computed: mapGetters(['prices']),
  created(){
    this.fetchPrices();
  }
}
</script>

<style lang="css" scoped>
</style>
