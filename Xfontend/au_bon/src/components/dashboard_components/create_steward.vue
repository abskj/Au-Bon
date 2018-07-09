<template>
    <div>
        <div class="row">
            <form class="col m12" @submit.prevent="Onsubmitted">
                <div class="row">
                    <div class="input-field col m6">
                        <i class="material-icons prefix">account_circle</i>
                        <input @focus="clearmsg" id="clearname" type="text" class="validate" v-model="name">
                        <label for="clearname">Name</label>
                    </div>
                    <div class="input-field col m6">
                        <i class="material-icons prefix">phone</i>
                        <input type="number" class="validate" v-model="mobile">
                        <label for="icon_telephone">Telephone</label>
                    </div>
                    <div>
                        <button class="btn" type="submit">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Axios from 'axios'
export default {
    data(){
        return{
            name:"",
            mobile:""
        }
    },
    props:{
        user:{
            type: Array
        }
    },
    methods:{
        Onsubmitted(){
            document.getElementById('clearname').innerHTML="submitting your request",
            Axios.post("http://127.0.0.1:8000/api/steward",{
                'name':this.name,
                'mobile':this.mobile,
                'branch_id':this.user[0]['branch_id']
            })
            .then(response=>{
                this.code=response.data.code;
                if(this.code==1){
                    document.getElementById('clearname').innerHTML='added successfully';
                    this.name='';
                    this.mobile='';
                      M.toast({html: 'Steward Added'})
                }})
            .catch(function(error){
                console.log(error);
                  M.toast({html: 'Steward could not be Added'})
            });
        },
        clearmsg(){
            document.getElementById('clearname').innerHTML=""
        }
    }
                    
}
</script>

<style>

  /* label color */
   .input-field label {
     color: #000;
   }
      /* valid color */
   .input-field input[type=text].valid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* invalid color */
   .input-field input[type=text].invalid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #000;
   }
   input{
       color: #000!important
   }
   input:focus{
       color: #000!important;
   }
        

</style>
