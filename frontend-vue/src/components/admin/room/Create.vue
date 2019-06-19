<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>
          <span v-if="id">Edit Room Details</span>
          <span v-if="!id">Create Room</span>
        </h2>
        <form @submit="onSubmit">
          <div class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="room.name">
              <span class="small text-danger" v-if="errors.name" v-for="error in errors.name" >{{error}}</span>
            </div>
          </div>
          <div class="row">
            <select-api event-send="roomTypeChange" :val="parseInt(room.room_type_id)" label="Room Type" route="/api/room-types">
              <span class="small text-danger" v-if="errors.room_type_id" v-for="error in errors.room_type_id" >{{error}}</span>
            </select-api>
            <select-api event-send="roomCapacityChange" :val="parseInt(room.room_capacity_id)" label="Room Capacity" route="/api/room-capacities">
              <span class="small text-danger" v-if="errors.room_capacity_id" v-for="error in errors.room_capacity_id" >{{error}}</span>
            </select-api>
          </div>
          <hr>
          <div class="row">

            <div class="form-group col-sm-12 col-md-6" v-if="id && id>0">
              <label>Current Image</label>
              <img :src="backend_endpoint+'/'+room.image" style="max-height:80px;" alt="" v-if="room.image && room.image != '/images/no-room.png'">
              <img src="/images/no-image.png" alt="" style="max-height:80px;" v-if="!room.image">
              <img src="/images/no-image.png" alt="" style="max-height:80px;" v-if="room.image == '/images/no-room.png'">
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label for="exampleFormControlFile1">Image</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" ref="image_m">
              <div class="" v-for="error in errors.image" v-if="errors.image">
                  <span class="small text-danger">{{error}}</span>
              </div>
            </div>
          </div>
          <hr>
          <div class="col-sm-12">
            <button type="submit" class="btn btn-success" name="button">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters,mapActions, mapMutations} from 'vuex';
export default {
  data(){
    return {
      id:'',
      bindProp:0,
      backend_endpoint:process.env.VUE_APP_BE,
    }
  },
  methods:{
    ...mapActions(['showRoom', 'AddOrUpdateRoom']),
    ...mapMutations(['cleanRoom']),
    onSubmit(e){
      e.preventDefault();
      if(!this.id) {
        if(!this.$refs.image_m.value) return this.$swal.fire(
          'Error!',
          'Image is required',
          'error'
        );
      } else delete this.room.image;
      if(this.$refs.image_m.value) {
        this.room.image = this.$refs.image_m.files[0];
      }
      this.AddOrUpdateRoom(this.room).then(res => {
        if(!this.id && res!='error') this.$router.push({ name: "rooms"});
      });
    }
  },
  computed:{
    ...mapGetters(['room', 'errors']),
  },
  created(){
    if(this.$route.params.id) {
      this.id = this.$route.params.id;
      this.showRoom(this.id);
    } else {
      this.cleanRoom();
    }
    this.$on('roomTypeChange', data=>{
      this.room.room_type_id = data;
    });
    this.$on('roomCapacityChange', data=>{
      this.room.room_capacity_id = data;
    });
  }

}
</script>

<style lang="css" scoped>
</style>
