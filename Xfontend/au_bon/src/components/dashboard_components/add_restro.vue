<template>
    <div class="red">
        <form @submit.prevent='RestroAdd'>
             <div class="row">
                <h4 class="heading condensed">
                    Add Restaurants to DB
                </h4>
            </div>
            <div class="row">
                <div class="col s6 m2 " style="padding-top:10px;">
                    <div class="center bold-text">
                        Name
                    </div>
                </div>
                <div class="col s6 m0">
                    <input type="text" maxlength="50" v-model="RestroName" name="r_name" id="r_name_field">
                </div>
            </div>
            <div class="row">
                <div class="col s6 m2 " style="padding-top:10px;">
                    <div class="center bold-text">
                        GSTIN
                    </div>
                </div>
                <div class="col s6 m0">
                    <input type="text" maxlength="15" v-model="GSTIN" name="gstin" id="gstin">
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
    <div>
        <p>IN restro{{user[0]['user_name']}}</p>
    </div>
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
            Axios.post("http://192.168.0.105:8001/api/restro",
            {
                'restro_name':this.RestroName,
                'gstin':this.GSTIN,
                'user_name':this.user[0]['user_name'],
                'role':this.user[0]['role']
            })
                .then(function (response){
                console.log(response);
            }).catch(function(error){
                console.log(error);
            });
        }
    }

}

</script>

<style>
input{
    color: black!important;
}
</style>
