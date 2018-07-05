<template>
    <div>
        <div class="container">
            <div class="row">
                <h4 class="heading condense">
                    Add branch</h4>
            </div>
            <div class="green-text" id='branch-msg'></div>
            <div class="row">
                <form @submit.prevent='Onsubmitted' class="col s12">
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">add_location</i>
                            <input @focus='clearmsg' id="icon_prefix" type="text" class="validate" v-model="address">
                            <label for="icon_prefix">address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">phone</i>
                            <input id="icon_telephone" type="number" class="validate" v-model="telephone">
                            <label for="icon_telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">pin_drop</i>
                            <input id="icon_telephone" type="number" class="validate" v-model="pin">
                            <label for="icon_telephone">pin</label>
                        </div>
                    </div>
                   <div class="row"> <div class="center">
                        <button class="btn" type="submit">submit</button>
                    </div></div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    data(){
        return{
            address:'',
            telephone:'',
            pin:''
        }
    },
    props:{
        user:{
            type: Array
        }
    },
    methods:{
        Onsubmitted(){
            document.getElementById("branch-msg").innerHTML="submitting your request",
            Axios.post("http://127.0.0.1:8000/api/branch",
            {
                'user_name':this.user[0]['user_name'],
                'role':this.user[0]['role'],
                'address':this.address,
                'pin':this.pin,
                'phone':this.telephone,
                'restro_id':this.user[0]['restro_id']
            })
            .then(response =>{
                this.code=response.data.code;
                if(this.code==1){
                    document.getElementById('branch-msg').innerHTML='branch added successfully';
                    this.address='';
                    this.telephone='';
                    this.pin=''
                }
            })
            .catch(function(error){
                     document.getElementById('restro-msg').innerHTML='Restaurant Could not be Added'
                console.log(error);
            });
        },
        clearmsg(){
            document.getElementById('branch-msg').innerHTML=''
        }
    }
}
</script>

<style>
input{
    color: black!important;
}
input:focus{
    color:black!important;
}
</style>
