<template>
    <div>
        <div class="shadow add-form">
            <div class="container">
                <div class="row">
                <h4 class="heading condense">
                    Add Food Category</h4>
            </div>
            <div class="green-text" id='branch-msg'></div>
            <div class="row">
                <form @submit.prevent='Onsubmitted' class="col s12">
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">label</i>
                            <input @focus='clearmsg' id="icon_prefix" type="text" class="validate" v-model="cat_id">
                            <label for="icon_prefix">Category Id(must be unique)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">create</i>
                            <input id="icon_telephone" type="text" class="validate" v-model="cat_name">
                            <label for="icon_telephone">Category Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">dns</i>
                            <input id="icon_telephone" type="text" class="validate" v-model="type">
                            <label for="icon_telephone">Type</label>
                        </div>
                    </div>
                   <div class="row"> <div class="center">
                        <button class="btn" type="submit">submit</button>
                    </div></div>
                </form>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    data(){
        return{
            cat_name:'',
            cat_id:'',
            type:''
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
            Axios.post("http://127.0.0.1:8000/api/foodCategory",
            {
                'user_name':this.user[0]['user_name'],
                'role':this.user[0]['role'],
                'cat_id':this.cat_id,
                'cat_name':this.cat_name,
                'type':this.type,
                'branch_id':this.user[0]['branch_id'],
                'stat_flag':1
            })
            .then(response =>{
                this.code=response.data.code;
                if(this.code==1){
                    document.getElementById('branch-msg').innerHTML='category added successfully';
                      M.toast({html: 'category Added Successfully'})
                    this.cat_id='';
                    this.cat_name='';
                    this.type=''
                }
            })
            .catch(function(error){
                     document.getElementById('restro-msg').innerHTML='Category Could not be Added,try changing the id'
                        M.toast({html: 'Category Could not be Added,try changing the id'})
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
.add-form{
    padding:2px;
}
</style>
