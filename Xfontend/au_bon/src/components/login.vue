<template>
    <form @submit.prevent="onSubmitted">
        <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                    <input  name="username" id="user_name" type="text" class="validate" v-model="username">
                    <label for="user_name">User Name</label>
                  </div>
            </div>
            <div class="row">
                    <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input name="password" id="password" type="password" class="validate" v-model="password">
                            <label for="password">Password</label>
                          </div>
            </div>
            <button type="submit" class="btn waves red">Login</button>
            </form>
    
</template>

<script>
import axios from 'axios';
export default {
data(){
    return {
        username:'',
    password:''
    }
},
methods:{
    onSubmitted(){
        axios.get('http://127.0.0.1:8000/api/user')
        .then(
            (response)=>console.log(response)
        ).catch(
            (error)=>console.log(error)
        )
    }
}
}
</script>

<style>

</style>
