<template>
        <div class="">
        <form @submit.prevent="onsubmitted">
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
                        <i class="material-icons prefix">portrait</i>
                        <input min='100000000000' max='999999999999' type="number" name="aadhar" id="aadhar" class="form-control" v-model="aadhar" placeholder="aadhar">
                        <label for="aadhar">aadhar</label>
                    </div>
                </div>
            <div class="row">
        
                    <div class="input-field col s12">
                           <i class="material-icons prefix">lock</i>
                            <input minlength="8" type="password" id="password"  class="form-control" placeholder="Password" v-model="password">  
                               <label for="password">Password</label>
                    </div>
                    </div>
            <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">portrait</i>
                        <input type="number" name="restro-id" id="restro-id" class="form-control" v-model="restroid" placeholder="restro-id">
                        <label for="restro-id">restro-id</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">phone_android</i>
                        <input min='1000000000' max='9999999999' type="number" name="mobile" id="mobile" class="form-control" v-model="mobile" placeholder="mobile">
                        <label for="mobile">mobile number</label>
                </div>
            </div>
            <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">text_fields</i>
                        <textarea id="address" class="materialize-textarea" v-model="address"></textarea>
                        <label for="address">address</label>
                    </div>
             </div>
             <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">portrait</i>
                        <input type="text" name="voter_id" id="voter_id" class="form-control" v-model="voter_id" placeholder="voter_id">
                        <label for="voter_id">voter ID </label>
                </div>
            </div>
             <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">portrait</i>
                        <input type="number" name="branch_id" id="branch_id" class="form-control" v-model="branch_id" placeholder="branch_id">
                        <label for="banch_id">Branch ID </label>
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
import Vue from 'vue';
import Axios from 'axios';

export default {
    data(){
        return{
            fullname:'',
            username:'',
            aadhar:'',
            password:'',
            restroid:'',
            mobile:'',
            address:'',
            voter_id:'',
            branch_id:'',



        }
    },
    props:{
        user:{
            type:Array
        }
    },
    methods:{
        onsubmitted(){
          alert('jhyfjy')
            Axios.post('http://127.0.0.1:8000/api/manager',
            {
                'user_name':this.username,
                'password':this.password,
                'aadhar_no':this.aadhar,
                'user_fname':this.fullname,
                'restro_id':this.restroid,
                'address':this.address,
                'mobile':this.mobile,
                'voter_id':this.voter_id,
                'branch_id':this.branch_id,
                'admin_name':this.user[0]['user_name'],

            })
        }
    }

}
</script>


<style>

</style>
