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
                            <input type="text" minlength="10" maxlength="200" name=""  v-model="customer_table">
                        </div>
                    </div>
                    <div class="row green lighten-3">
                       <!--  -->
                    <add-to-bill v-bind="items" v-bind:user="user" v-on:item-added="fillitems"></add-to-bill>

                    </div>
                                 <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Discount Rate:
                                      </div>
                                        <div class="col m3">
                                                <input type="number" step="0.01" name=""    v-model="discount_rate">
                                        </div>
                                        <div class="col m3">Customer Type</div>
                                        <div class="col m3">
                                            <select class="browser-default" name="" >
                                                <option value="">Student</option>
                                                <option value="">Special</option>
                                                <option value="">Student</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                   
                    <div class="row">
                        <div class="center">
                            <button id="trans-submit" type="submit" class="btn waves green">Finish Transaction</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s12 m6 container">
                <div class="center">
                    <h3 class="heading">Preview</h3>
                </div>
                <div>
                    Status
                    <div class="thin container">
                        Transaction id: {{tran_id}}<br>
                        first_tran: {{first_tran}}<br>
                        Cutomer exists : {{cust_exists}}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>

import axios from 'axios';

import addtoBill from './transaction/addToBill.vue';
export default {
     props:{
        user:{
            type: Array
        }
    },
    components:{
       
        'add-to-bill':addtoBill,
    },
    data(){
        return{
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

        }
    },
    methods:{
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
                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.tran_id=response.data.id;
                                             M.toast({html: 'Transaction started'}) ;
                                             this.first_tran=0;
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
                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.tran_id=response.data.id;
                                             M.toast({html: 'Transaction started'}) ;
                                             this.first_tran=0;
                                        }

                                    ).catch(function (error) {
                                        console.log(error);
                                    })

               }  
                

            }
            else{
              
                 axios.post('http://127.0.0.1:8000/api/part-transaction', {
                            'cust_id': this.cust_no,
                            'user_name' :this.user[0]['user_name'],
                            'branch_id':this.user[0]['branch_id'],
                            'cat_id':this.food_cat,
                            'qty':this.item_quantity,
                            'rate':this.item_rate,
                            'tran_id':this.tran_id,
                            'item_id':this.item_code,


                        },{
                            headers:[]
                        }).then(
                            (response) => {
                                 M.toast({html: 'Added to bill'})

                            }
                        ).catch(function (error) {
                            console.log(error);
                        })
            }

        },
       
        transactionSubmit(){
            document.getElementById("trans-submit").innerHTML='Submitting ...'
            
            document.getElementById("trans-submit").innerHTML='Done'

        },
       nextItem(){

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
        }
      
    }

}
</script>

<style>
.container{
    border: 2px blueviolet solid;
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
#trans-submit{
    
}

</style>
