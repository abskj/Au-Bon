<template>
<div id="main">
    <div>
        <app-login v-on:login-successful="loginSuccess"></app-login>
    </div>
</div>
    
</template>

<script>
import Login from './login.vue';
export default {
components:{
    'app-login':Login
},
methods:{
    loginSuccess($event){
        console.log('Hahahaha');
        document.getElementById('main').innerHTML=$event+'<h1>Now the dashboard will open</h1>';

    }
}
}
</script>

<style>

</style>
