<template>
<div id="main">
     <div v-if="logged_in">
        <app-dashboard v-bind:user='user'></app-dashboard>

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
                role:0,
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
    loginSuccess(fullname,role,restro_id,branch_id,username){
        this.logged_in=true;
      x={
           user_fullname:fullname,
       restro_id:restro_id,
       branch_id:branch_id,
       user_name:username,
      }
      this.user[0]=x;

    }
}
}
</script>

<style>

</style>
