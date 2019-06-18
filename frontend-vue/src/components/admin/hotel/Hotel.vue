<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Hotel Edit Details</h2>

        <form>
          <div class="row">
            <div class="form-group col-sm-12 col-md-6">
              <label>Name</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Address</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>City</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>State</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Country</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Zip Code</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Phone Number</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label>Image</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-sm-12 col-md-6">
              <label for="exampleFormControlFile1">Image</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'hotel',
}
</script>

<style lang="css" scoped>
</style>
