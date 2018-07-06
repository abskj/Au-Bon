<template>
     <div>
         <div class="modal-content">
                   <div class="center">
                        <h4>SETTLE THE TRANSACTION</h4>
                   </div>
                    <p>A bunch of text</p>
                    </div>
                  <form @submit.prevent="settle">
                          <div class="row">
                            <div class="row">
                                <div class="col m3 offset-m1">
                                <div style="margin-top:25px;">
                                    Choose Payment Option
                                </div>
                            </div>
                            <div class="input-field col m4 ">
                                <select class="browser-default" v-model="settle_mode">
                                
                                <option value="1">Card</option>
                                <option value="0" selected>Cash</option>
                            
                                </select>
                            
                            </div>
                          </div>
                          <div class="" id="optional">
                              <div style="margin-top:15px;" class="row">
                             <div class="col m3 offset-m1">
                                 Card Number:
                             </div>
                             <div class="col m4 ">
                                  <input type="number" name="" id="" v-model="card_no">
                             </div>
                          </div>
                          <div style="margin-top:15px;" class="row">
                             <div class="col m3 offset-m1">
                                Bank name:
                             </div>
                             <div class="col m4 ">
                                  <input type="text" maxlength="30" name="" id="" v-model="bank">
                             </div>
                          </div>
                          </div>
                          <div class="row">
                              <div class="center">
                                  <button class="green btn-large btn waves white-text" type="submit">Settle</button>
                              </div>
                          </div>
                      </div>
                      
                  </form>
                
                    
     </div>
</template>

<script>
 import axios from "axios";
export default {
   
    props: {
        tranId:{
            type: String
        }
    },
    watch:{
        tran_id: {
            handler: function(oldVal, newVal){
                
            }
        },
        settle_flag: {
            handler: function(nu, old){
                if(nu===1){
                    document.getElementById('optional').style.visibility='hidden'
                }
                else {
                     document.getElementById('optional').classList.style.visibility='visible'
                   
                }
            }
        }
       
    },
    data(){
        return {
            //0 cash
            //1 card
            settle_flag:0,
            card_no:0,
            bank: '',
        }
    },
    methods:{
        settle(){
            axios.post('http://127.0.0.1:8000/api/settle',{
                'tran_id' : this.tranId,
                'settle_mode' : this.settle_flag,
                 'card_number':this.card_no,
                 'bank':this.bank,
            }).then((response)=>{
                M.toast({html:'Transaction completed'})
                this.$emit('complete')
            }).catch(function(err){
                 console.log(err)
                M.toast({html:'Transaction failed'})
            })
               
            
        },
    }

}
</script>

<style>

</style>
