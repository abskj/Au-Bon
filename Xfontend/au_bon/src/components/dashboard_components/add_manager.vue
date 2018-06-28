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
                    <div>
                        <input v-validate="'required|length:12'" type="number" name="aadhar" id="aadhar" class="form-control" v-model="aadhar" placeholder="aadhar">
                    </div>
                    <div>
                        <p v-show="errors.has('aadhar')">{{errors.first("aadhar")}}</p>
                    </div>
            </div>
            <div class="row">
        
                    <div> <!--class="input-field col s12">-->
                           <i class="material-icons prefix">lock</i>
                            <input v-validate="'required|min:8|verify_password'" type="password" name="password" class="form-control" placeholder="Password">                            <label for="password">Password</label>
                          </div>
                                   <div>   <p v-show="errors.has('password')" >{{ errors.first('password') }}</p></div>
                </div>
            <!-- <div class="row">
        
                    <div><!--class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input data-vv-as="password confirmation" v-validate="'required|confirmed:password'" type="password" name="password_confirmed" class="form-control" placeholder="Confirm Password">                            <label for="confirm-password">Confirm Password</label>
                          </div>
                        <p v-show="errors.has('password_confirmed')" >{{ errors.first('password_confirmed') }}</p>
            </div>-->
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
import veevalidate from 'vee-validate';
import Vue from 'vue';
Vue.use(veevalidate);

export default {

}
</script>

<style>

</style>
