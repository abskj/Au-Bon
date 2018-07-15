<template>
    <div>
        <div class="shadow add-form">
            <div class="container">
                <div class="row">
                <h4 class="heading condense">
                    Add Food Item</h4>
            </div>
            <div class="green-text" id='branch-msg'></div>
            <div class="row">
                <form @submit.prevent='Onsubmitted' class="col s12">
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">label</i>
                            <input @focus='clearmsg' id="icon_prefix" type="text" class="validate" maxlength="15" v-model="item_id">
                            <label for="icon_prefix">Item Id(must be unique)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">create</i>
                            <input id="icon_telephone" type="text" class="validate" v-model="item_name">
                            <label for="icon_telephone">Item Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">create</i>
                            <input id="icon_telephone" type="number" step="0.01" class="validate" v-model="item_rate">
                            <label for="icon_telephone">Item Rate</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">dns</i>
                            <input id="icon_telephone" type="number" class="validate"  v-model="HSN_code">
                            <label for="icon_telephone">HSN Code</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">dns</i>
                            <input id="icon_telephone" type="number" class="validate" v-model="SGST">
                            <label for="icon_telephone">SGST</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <i class="material-icons prefix">dns</i>
                            <input id="icon_telephone" type="number" class="validate" v-model="CGST">
                            <label for="icon_telephone">CGST</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                           <div class="row">
                                <div class="col s3" style="font-size:1.2em">Category</div>
                            <div class="col s9"> <select class="browser-default" @focus="getCat" v-model="cat_id">
                                <option v-for="cat in cats">
                                   {{cat.cat_name}}
                                   {{cat.cat_id}}
                                </option>
                               
                            </select></div>
                           </div>
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
            item_name:'',
            cat_id:'',
            CGST:'',
            SGST:'',
            HSN_code:'',
            item_rate:'',
            item_id:'',
            cats:[{}],
        }
    },
    props:{
        user:{
            type: Array
        }
    },
    watch:{
        user:{
            handler: function(nu,old){
                this.getCat();
            }
        }
    },
    methods:{
        setCat(cat){
            this.cat_id=cat.cat_id
        }
        ,
        getCat(){
            Axios.post(backend+"/get-foodCategory",{
                'user_name':this.user[0]['user_name'],
                'role':this.user[0]['role'],
                'branch_id':this.user[0]['branch_id'],
            }).then((response) => {
                this.cats=response.data.data;
            }).catch(function(err){
                console.log(err)
                M.toast({html: 'Could not fetch category'})
            })
        },
        Onsubmitted(){
            document.getElementById("branch-msg").innerHTML="submitting your request",
            Axios.post(backend+"/foodItem",
            {
                'user_name':this.user[0]['user_name'],
                'role':this.user[0]['role'],
                'cat_id':this.cat_id,
                'item_id':this.item_id,
                'HSN_code':this.HSN_code,
                'item_rate':this.item_rate,
                'SGST':this.SGST,
                'CGST':this.CGST,
                'item_name':this.item_name,
                'branch_id':this.user[0]['branch_id'],
                'stat_flag':1
            })
            .then(response =>{
                this.code=response.data.code;
                if(this.code==1){
                    document.getElementById('branch-msg').innerHTML='Item added successfully';
                     M.toast({html: 'Item added successfully'})
                    this.cat_id='';
                    this.cat_name='';
                    this.type=''
                        this.item_name='';
                        this.cat_id='';
                        this.CGST='';
                        this.SGST='';
                        this.HSN_code='';
                        this.item_rate='';
                        this.item_id='';
                       
                }
            })
            .catch(function(error){
                     document.getElementById('restro-msg').innerHTML='Item Could not be Added,try changing the id'
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
input,select{
    color: black!important;
}
input,select:focus{
    color:black!important;
}
.add-form{
    padding:2px;
}
</style>
