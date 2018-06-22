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
    loginSuccess(fullname,role){
        console.log('Hahahaha');
        document.getElementById('main').innerHTML=role+'<h1>Welcome '+fullname+'</h1>';

    }
}
}
</script>

<style>

</style>
