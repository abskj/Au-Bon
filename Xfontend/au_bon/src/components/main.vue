<template>
<div id="main">
     <div v-if="logged_in">
        <app-dashboard v-on:logout="logout" v-bind:loginControl="logged_in" v-bind:user='user'></app-dashboard>

    </div>
    <div v-else >
        <app-login v-on:login-successful="loginSuccess"></app-login>
    </div>
   
</div>
    
</template>

<script>
import Login from './login.vue';
import Dashboard from './dashboard2.vue';
export default {
    data(){
        return {
            logged_in:false,
             user: [{
                user_name:'admin',
                role:5,
                user_fullname:'abcdefg',
                branch_id:'1',
                restro_id:'1'

            }],

        }
    },
components:{
    'app-login':Login,
    'app-dashboard':Dashboard
},
methods:{
    loginSuccess(fullname,role1,restro_id,branch_id,username){
        console.log(branch_id)
     
        this.logged_in=true;
             var x={
              user_fullname:fullname,
              restro_id:restro_id,
              branch_id:branch_id,
              user_name:username,
              role:role1,
      }
      this.user.splice(0,0,x);

    },
    logout(){
                this.logged_in=false;
               
                
    }
}
}
</script>

<style>
.shadow{
      box-shadow: 0px 0px 15px rgba(128, 128, 128, 0.768);
      padding:5px 5px;
}
</style>
