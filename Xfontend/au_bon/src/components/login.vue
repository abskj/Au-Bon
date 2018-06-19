<template>
   <div id="full">
       <div class="row" style="height:15vh"></div>
       <div class="row">
           <div class="col m4">

           </div>
           <div class="col m2 login-form">
                          <div class="row">
                               <div class="login__check center">
                                   <i class="material-icons">check</i>
                               </div>
                          </div>

                <form @submit.prevent="onSubmitted">
                    <div class="row">
                        <div class="input-field col s12">
                          <div class="row">
                              <div class="col s2">
                                   <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                 <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                           </svg>
                              </div>
                              <div class="col s10">
                                  
                            <input name="username" id="user_name" type="text" class="validate" v-model="username" placeholder="Username">
                        
                              </div>
                              </div>   
                        </div>
                    </div>
                                    <div class="row">
                    <div class="input-field col s12">
                        <div class="row">
                            <div class="col s2">
                                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                                    <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                                                </svg>
                            </div>
                            <div class="col s10">
                                <input name="password" id="password" type="password" class="validate" v-model="password" placeholder="password">

                            </div>
                        </div>



                    </div>
                </div>
                    <div class="row">
                        <div class="center">
                            <button type="submit" class="btn waves red">Login</button>
                        </div>
                    </div>
                </form>
           </div>
       </div>
   </div>
    
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
#full{
      background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/142996/slider-2.jpg");
    background-size: cover;
    overflow: auto;
    font-family: "Open Sans", Helvetica, Arial, sans-serif;
    height: 100vh;
    width: 100vw;
}
.login-form{
    min-width: 300px;
    background-color: rgba(52, 39, 39, 0.707);
}
svg path{
    stroke: rgba(255, 255, 255, 0.9);
    fill:none;
    stroke-width: 1;
}
.login__check i{
   
    color: white;
    font-size: 10em;
    font-weight: bold;
}

</style>
