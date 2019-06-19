<template>
  <div :class="className">
    <label for="exampleFormControlSelect1">{{label}}</label>
    <select class="form-control" id="exampleFormControlSelect1" v-model="bindProp" @change="emitChange">
      <option v-for="item in items" :key="item.id" :value="item.id">{{item.name}}</option>
    </select>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  props:{
    eventSend:{
      type: String,
      required: true,
    },
    route:{
      type: String,
      required: true
    },
    val:{
      type:Number,
      required: false
    },
    label:{
      type:String,
      required: false
    }
  },
  data(){
    return {
      className:'col-sm-12 col-md-6 form-group',
      items: [],
      bindProp:0,
    }
  },
  methods:{
    async getItems(){
      try {
        const items = await axios.get(process.env.VUE_APP_BE+this.$props.route);
        this.items = items.data;
      } catch (e) {
        //console.log(e);
      }
    },
    emitChange(){
      this.$parent.$emit(this.$props.eventSend, this.bindProp);
    }
  },
  created(){
    this.getItems();
    if(this.$props.val) this.bindProp = this.$props.val;
  },
  watch:{
    val(n){
      this.bindProp = n;
    }
  }
}
</script>

<style lang="css" scoped>
</style>
