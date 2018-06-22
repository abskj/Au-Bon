<template>
        <div class="">
        <form action="">
             <div class="row">
                <h4 class="heading condensed">
                    Create a Manager
                </h4>
            </div>
                        <div class="row">
                <div class="input-field col s12">
                                            <i class="material-icons prefix">description</i>

                    <input  name="fullname" id="fullname" type="text" class="validate" v-model="fullname">
                    <label for="fullname">Full Name</label>
                  </div>
            </div>
             <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                    <input  name="username" id="user_name" type="text" class="validate" v-model="username">
                    <label for="user_name">User Name</label>
                  </div>
             </div>
             <div class="row">
                 <select name="" id="">
                     <option value="1">Restr1</option>
                 </select>
             </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="number" name="aadhar" id="aadhar" class="validate" v-model="aadhar">
                    <label for="aadhar">Aadhar Number</label>
                </div>
            </div>
            <div class="row">
        
                    <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input name="password" id="password" type="password" class="validate" v-model="password">
                            <label for="password">Password</label>
                          </div>
            </div>
            <div class="row">
                <div class="">
                    
  <button class="btn waves-effect waves-light btn-large yellow darken-3" type="submit" name="action">Create
    <i class="material-icons right">add</i>
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
