<template>
    <div class="container">
        <div class="row">
            <h3 class="heading white teal-text">Create a User</h3>
        </div>
        <div class="white lighten-3 black-text">
            <form @submit.prevent="onFormSubmit">
                 <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                    <input  name="username" id="user_name" type="text" class="validate" v-model="username">
                    <label for="user_name">User Name</label>
                  </div>
             </div>
             <div class="row">
                <div class="input-field col s12">
                                            <i class="material-icons prefix">account_circle</i>

                    <input  name="fullname" id="fullname" type="text" class="validate" v-model="fullname">
                    <label for="fullname">Full Name</label>
                  </div>
            </div>
            <div class="row">
                    <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input name="password" id="password" type="password" class="validate" v-model="password">
                            <label for="password">Password</label>
                          </div>
            </div>
            <button type="submit" class="yellow darken-4 waves btn"> Create</button>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data:{
            username:'',
            fullname:'',
            password:''
        },
        methods:{
            onFormSubmit(){
                axios.post('http://127.0.0.1:8000/api/user',{
                    'username' : username,
                    'password' : password,
                    'fullname' : fullname,
                    'status'   : 1,
                    'role'     : 0
                })
                .then(function(response){
                    console.log(response);
                })
                .catch(function(error){
                    console.log(error);
                });

            }
        }
    }
</script>

<style>
</style>