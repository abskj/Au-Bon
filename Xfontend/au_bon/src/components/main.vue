<template>

<div id="main">
     <div v-if="logged_in">
        <app-dashboard></app-dashboard>

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

        }
    },
components:{
    'app-login':Login,
    'app-dashboard':Dashboard
},
methods:{
    loginSuccess(fullname,role){
        this.logged_in=true;
    }
}
}
</script>

<style>

</style>
