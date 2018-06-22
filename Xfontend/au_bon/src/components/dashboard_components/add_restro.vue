<template>
    <div class="">
        <form action="">
             <div class="row">
                <h4 class="heading condensed">
                    Add Restaurants to DB
                </h4>
            </div>
            <div class="row">
                <div class="col s6 m2 " style="padding-top:10px;">
                    <div class="center bold-text">
                        Name
                    </div>
                </div>
                <div class="col s6 m0">
                    <input type="text" maxlength="50" name="r_name" id="r_name_field">
                </div>
            </div>
            <div class="row">
                <div class="col s6 m2 " style="padding-top:10px;">
                    <div class="center bold-text">
                        GSTIN
                    </div>
                </div>
                <div class="col s6 m0">
                    <input type="text" maxlength="15" name="gstin" id="gstin">
                </div>
            </div>
            <div class="row">
                <div class="">
                    
  <button class="btn waves-effect waves-light btn-large" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
