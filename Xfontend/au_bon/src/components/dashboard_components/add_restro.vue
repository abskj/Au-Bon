<template>
    <div class="white">
        <form @submit.prevent='RestroAdd'>
             <div class="row">
                <h4 class="heading condensed">
                    Add Restaurants to DB
                </h4>
                <div class="green-text" id="restro-msg"></div>
            </div>
            <div class="row">
                <div class="col s6 m2 " style="padding-top:10px;">
                    <div class="center bold-text">
                        Name
                    </div>
                </div>
                <div class="col s6 m0">
                    <input @focus="clearMsg" type="text" maxlength="50" v-model="RestroName" name="r_name" id="r_name_field">
                </div>
            </div>
            <div class="row">
                <div class="col s6 m2 " style="padding-top:10px;">
                    <div class="center bold-text">
                        GSTIN
                    </div>
                </div>
                <div class="col s6 m0">
                    <input type="text" @focus="clearMsg" maxlength="15" v-model="GSTIN" name="gstin" id="gstin">
                </div>
            </div>
            <div class="row">
                <div class="">
                    
  <button class="btn waves-effect waves-light btn-large" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
                </div>
            </div>
        </form>
   
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    data(){
        return {
            RestroName:'',
            GSTIN:''
        }
    },
    props: {
        user: {
            type: Array
        }
    },
    methods:{
        RestroAdd(){
             document.getElementById('restro-msg').innerHTML='Submitting your request';
            Axios.post("http://127.0.0.1:8000/api/restro",
            {
                'restro_name':this.RestroName,
                'gstin':this.GSTIN,
                'user_name':this.user[0]['user_name'],
                'role':this.user[0]['role']
            })
                .then(response => {
                    this.code=response.data.code;
                    if(this.code==1){
                        document.getElementById('restro-msg').innerHTML='Restaurant Added Successfully';
                        this.RestroName='';
                        this.GSTIN='';
                    }
                })
                .catch(function(error){
                     document.getElementById('restro-msg').innerHTML='Restaurant Could not be Added'
                console.log(error);
            });
        },

        clearMsg(){
            document.getElementById('restro-msg').innerHTML=''
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
