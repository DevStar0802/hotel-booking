<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Room Manager</h2>
        <div class="row my-2">
          <div class="col-sm-6">
              <router-link :to="{name: 'rooms-create'}" class="btn btn-success mx-2">Create</router-link>
          </div>
        </div>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Name</td>
                <td>Actions</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="room in rooms" :key="room.id">
                <td>{{room.id}}</td>
                <td>{{room.name}}</td>
                <td>
                  <router-link :to="{name: 'rooms-edit', params:{id:room.id}}" class="btn btn-info mx-2">Edit</router-link>
                  <button type="button" @click="removeItem(room.id)" class="btn btn-danger mx-2">Delete</button>
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
    ...mapActions(['fetchRooms','deleteRoom']),
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
          this.deleteRoom(id);
        }
      })
    },
  },
  computed: mapGetters(['rooms']),
  created(){
    this.fetchRooms();
  }
}
</script>

<style lang="css" scoped>
</style>
