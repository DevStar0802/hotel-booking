<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Room Types</h2>
        <div class="row my-2">
          <div class="col-sm-6">
              <input type="text" v-model="create_input" class="form-control">
          </div>
          <div class="col-sm-6">
              <button type="button" @click="createItem()" class="btn btn-success mx-2">Create</button>
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
              <tr v-for="type in room_types" :key="type.id">
                <td>{{type.id}}</td>
                <td>
                  <span v-if="edit_item != type.id">{{type.name}}</span>
                  <input type="text" v-model="edit_input" class="form-control" v-if="edit_item == type.id">
                </td>
                <td>
                  <button type="button" @click="saveEdit(type)" name="button" class="btn btn-success mx-2" v-if="edit_item == type.id" >Save</button>
                  <button type="button" @click="cancelEdit" name="button" class="btn btn-danger mx-2" v-if="edit_item == type.id">Cancel</button>
                  <button type="button" class="btn btn-info mx-2" @click="editItem(type)" v-if="edit_item != type.id">Update</button>
                  <button type="button" @click="removeItem(type.id)" class="btn btn-danger mx-2" :disabled="edit_item==type.id">Delete</button>
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
      create_input: '',
      edit_input:'',
      edit_item:0
    }
  },
  methods:{
    ...mapActions(['fetchTypes', 'addType', 'deleteType', 'updateType']),
    createItem(){
      if(this.create_input) {
        this.addType({name:this.create_input});
        this.create_input = '';
        this.$swal.fire(
          'Good job!',
          'Hotel updated!',
          'success'
        );
      }
    },
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
          this.deleteType(id);
        }
      })
    },
    editItem(item){
      this.edit_item = item.id;
      this.edit_input = item.name;
    },
    cancelEdit(){
      this.edit_item = 0;
      this.edit_input = '';
    },
    saveEdit(item){
      if(this.edit_input) {
        this.updateType({id:item.id,name:this.edit_input});
        this.$swal.fire(
          'Good job!',
          'Item updated!',
          'success'
        ).then(()=>this.cancelEdit());

      }
    }
  },
  computed: mapGetters(['room_types']),
  created(){
    this.fetchTypes();
  }
}
</script>

<style lang="css" scoped>
</style>
