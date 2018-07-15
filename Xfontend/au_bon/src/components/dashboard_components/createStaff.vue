<template>
    <div>
        <div class="row">
            <form @submit.prevent="Onsubmitted" class="col s12">
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="name" type="text" class="validate" v-model="name">
                  <label for="icon_prefix">user name</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">phone</i>
                  <input id="mobile" type="number" class="validate" v-model="mobile">
                  <label for="icon_telephone">Telephone</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">lock</i>
                  <input id="PASSWORD" type="password" class="validate" v-model="password">
                  <label for="PASSWORD">password</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="userfullname" type="text" class="validate" v-model="fullname">
                  <label for="userfullname">Full name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">location_on</i>
                  <input id="address" type="text" class="validate" v-model="address">
                  <label for="address">address</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="voterid" type="text" class="validate" v-model="voterid">
                  <label for="voterid">voter id</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="adahar_no" type="text" class="validate" v-model="adahar">
                  <label for="adahar_no">Aadhar no</label>
                </div>
              </div>
              <div>
                  <button class="btn" type="submit">submit</button>
              </div>
        </form>
  </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            name:'',
            password:'',
            adahar:'',
            fullname:'',
            address:'',
            mobile:'',
            voterid:''
        }
    },
 props: {
        user: {
            type: Array
        }
    },
    methods:{
        Onsubmitted(){
          
            axios.post(backend+"/staff",
            {
            'user_name':this.name,
            'password':this.password,
            'aadhar_no':this.adahar,
            'user_fname':this.fullname,
            'address':this.address,
            'admin_name':this.user[0]['user_name'],
            'restro_id':this.user[0]['restro_id'],
            'mobile':this.mobile,
            'voter_id':this.voterid,
            'branch_id':this.user[0]['branch_id']
            },{
            headers:{}
        })
            .then(function(response){
                console.log(response);
                 M.toast({html: 'Staff Added'})
            }).catch(function(error){
                console.log(error);
                 M.toast({html: 'Staff could not be Added'})
            });
        }
    }
}
</script>

<style>

</style>
