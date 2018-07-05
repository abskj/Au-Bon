<template>
    <div id="trans">
        <div class="row">
            <h4 class="heading container">
            Transaction
        </h4>
        </div>
        <div class="row ">
            <div class="col s12 m6">
                <form action="" class="" @submit.prevent="transactionSubmit">
                     <div class="row ">
                        <div class="col m3 label">
                            Customer Mobile Number:
                        </div>
                        <div class="col m9">
                            <input @blur="getCustomerInfo" @keypress.enter="getCustomerInfo" type="number" minlength="10"  id="customer_no" v-model="cust_no">
                        </div>
                    </div>
                    <!--
                        hidden input for tranid
                        -->
                        <input type="hidden" id="transactionId" v-model="tran_id">
                    <div class="row ">
                        <div class="col m3 label">
                            Customer Name:
                        </div>
                        <div class="col m9">
                            <input type="text" name="" id="customer_name" v-model="cust_name">
                        </div>
                    </div>
                   
                   
                    <div class="row">
                        <div class="col m3 label">
                            Customer Address:
                        </div>
                        <div class="col m9">
                            <input type="text" id="customer_addr"  minlength="10" maxlength="200" name="" v-model="cust_addr">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m3 label">
                            Table:
                        </div>
                        <div class="col m3">
                            <input type="text" minlength="10" maxlength="200" name=""  v-model="table">
                        </div>
                    </div>
                    <div class="row container">
                        <select-steward v-bind:flag="resetController" v-bind:user="user" v-on:steward-added="setSteward"></select-steward>
                    </div>
                    <div class="row container">
                       <!--  -->
                    <add-to-bill v-bind:flag="resetController" v-bind="items" v-bind:user="user" v-on:item-added="fillitems"></add-to-bill>

                    </div>
                                 <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Discount Rate:
                                      </div>
                                        <div class="col m3">
                                                <input type="number" step="0.01" name=""    v-model="discount_rate">
                                        </div>
                                      
                                    </div>
                                </div>
                   
                    <div class="row container">
                        <div class="col m6">
                           <div class="row"></div>
                            <button id="trans-submit" type="submit" class="btn waves green">Finish Transaction</button>
                        </div>
                        <div class="col m6">
                            <div class="row">
                                <button id="trans-reset"  @click="reset" class="btn waves blue">Reset Transaction</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s12 m6 container">
               
                <div>
                   <app-preview v-bind:user="user" v-bind:transactionId="this.tran_id" v-bind:flag="previewControl"></app-preview>
                </div>
            </div>
            
        </div>
        <div id="modal1" class="modal">
           
                   <settle-bill></settle-bill>
         </div>
    </div>
</template>

<script>
import Preview from './transaction/preview.vue';
import axios from 'axios';
import Steward from './transaction/steward.vue';
import addtoBill from './transaction/addToBill.vue';
import Settle from './transaction/settle.vue';
export default {

     props:{
        user:{
            type: Array
        }
    },
    components:{
       
        'add-to-bill':addtoBill,
         'app-preview' : Preview,
         'select-steward' : Steward,
         'settle-bill' : Settle,
    },
    data(){
        return{
            previewControl:0,
            cust_no:'',
            cust_addr:'',
            cust_exists:false,
            cust_name:'',
            item_name:'',
            items:[{}],
            item_code:'',
            item_rate:'',
            item_quantity:0,
            first_tran:1,
            tran_id:'',
            food_cat:'',
            table:0,
            discount_rate:0.00,
            steward_id:'',
            resetController:1,

        }
    },
    methods:{
        reset(){
             this.previewControl=0;
             this.cust_no='';
              this.cust_addr='';
              this.cust_exists=false;
               this.cust_name='';
             this.item_name='';
             this.items=[{}];
               this.item_code='';
               this.item_rate='';
            this.item_quantity=0;
             this.first_tran=1;
              this.tran_id='';
           this.food_cat='';
             this.table=0;
           this. discount_rate=0.00;
           this.steward_id='';
           this.resetController++;

        },
        fillitems(code,qty){
            console.log('add to button pressed')
            this.item_code=code;
            this.item_quantity=qty;
            
            if(this.first_tran===1){
            console.log('first transaction')
                
               if(this.cust_exists===false){
                     console.log('new customer')
                   //add customer
                            axios.post('http://127.0.0.1:8000/api/customerCreate', {
                            'mobile': this.cust_no,
                            'name' :this.cust_name,
                            'address':this.cust_addr,
                        },{
                            headers:[]
                        }).then(
                            () => {
                                this.cust_exists=true;
                                M.toast({html: 'Customer added'}) ;
                                 //initialize transaction
                                    axios.post('http://127.0.0.1:8000/api/start-transaction', {
                                        'cust_id': this.cust_no,
                                        'user_name' :this.user[0]['user_name'],
                                        'branch_id':this.user[0]['branch_id'],
                                        'steward_id' :this.steward_id,
                                        'table_no' : this.table,

                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.tran_id=response.data.id;
                                             M.toast({html: 'Transaction started'}) ;
                                             this.first_tran=0;
                                             this.previewControl++;
                                               this.addItemToBill()
                                        }

                                    ).catch(function (error) {
                                        console.log(error);
                                    })
                                   
                                        },

                        ).catch(()=> {
                              M.toast({html: 'There was some problem while communicating'})
                        });
                       

                       
               }
               else{
                    axios.post('http://127.0.0.1:8000/api/start-transaction', {
                                        'cust_id': this.cust_no,
                                        'user_name' :this.user[0]['user_name'],
                                        'branch_id':this.user[0]['branch_id'],
                        'steward_id' :this.steward_id,
                        'table_no' : this.table,
                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.tran_id=response.data.id;
                                             M.toast({html: 'Transaction started'}) ;
                                             this.first_tran=0;
                                             this.previewControl++;
                                               this.addItemToBill()
                                        }

                                    ).catch(function (error) {
                                        console.log(error);
                                    })

               }  
                

            }
            else{
                this.addItemToBill()
            }

        },
       
        transactionSubmit(){
            document.getElementById("trans-submit").innerHTML='Submitting ...'
            var elems=document.getElementById('modal1');
            var modal=M.Modal.init(elems, {
                'startingTop': '25%',
                'dismissible' :false,
            })
            modal.open()
            document.getElementById("trans-submit").innerHTML='Done'

        },
       setSteward(id,name){
            this.steward_id=id;

            console.log(name);
       },
        getCustomerInfo(){

            axios.post('http://127.0.0.1:8000/api/customer', {
                'mobile': this.cust_no,
            },{
                headers:[]
            }).then(
                response=>{
                    this.cust_no=response.data.customer_mobile,
                    this.cust_id=response.data.customer_id,
                    this.cust_addr=response.data.customer_addr,
                    this.cust_name=response.data.customer_name,
                    this.cust_exists=true;
                }
            ).catch(error=>
            {
                
                    this.cust_id='',
                    this.cust_addr='',
                    this.cust_name='',
                    this.cust_exists=false;
            }
            
            );
        },
        addItemToBill(){
               axios.post('http://127.0.0.1:8000/api/part-transaction', {
                            'cust_id': this.cust_no,
                            'user_name' :this.user[0]['user_name'],
                            'branch_id':this.user[0]['branch_id'],
                            'cat_id':this.food_cat,
                            'qty':this.item_quantity,
                            'rate':this.item_rate,
                            'tran_id':this.tran_id,
                            'item_id':this.item_code,
                            'item_name':this.item_name,


                        },{
                            headers:[]
                        }).then(
                            (response) => {
                                 M.toast({html: 'Added to bill'});
                                 this.previewControl--;

                            }
                        ).catch(function (error) {
                            console.log(error);
                        })
        }
      
    }

}
</script>

<style>
.container{
    border: 2px rgb(21, 18, 24) solid;
}
#trans input{
    color:black!important;
    height: 1.2em;
    margin-bottom: 1px;
}

#trans input:focus{
    color:black!important;
}
#trans form{
    margin: 10px;
}
#trans * .row
{
    margin-bottom: 10px;
}
.label{
    
    font-weight: 600;
}

</style>
