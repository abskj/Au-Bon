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

                    <div class="row ">
                        <div class="col m3 label">
                            Customer Name:
                        </div>
                        <div class="col m9">
                            <input type="text" name="" id="customer_name" v-model="cust_name">
                        </div>
                    </div>
                    <input type="hidden" id="customer_exists" v-model="cust_exists" >
                   
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
                        <form action="">
                            <div class="col m12">
                                
                                
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Food Category:
                                      </div>
                                        <div class="col m3">
                                                <input disabled type="text" minlength="10" maxlength="200" name=""    v-model="food_cat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="col m2 label">
                                                Item:
                                        </div>
                                        <div class="col m4">
                                             
                                             <item-input v-bind:user="user" v-on:got-items="showItems" @keyup='nextItem'></item-input>
  
                                        </div>

                                        <div class="col m6">
                                            <div class="row">
                                                <div class="col m2 label">
                                                        Code:
                                                </div>
                                                <div class="col m4">
                                                    <input   v-model="item_code">
        
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="row white ">
                                      
                                        <ul >
                                            <li v-for="item in items" @click="selectItem(item)" class="">
                                                <hr>
                                                {{item.item_name}}
                                                 <hr>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Item Quantity:
                                      </div>
                                        <div class="col m3">
                                                <input type="number"  name=""    v-model="item_quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Item Rate:
                                      </div>
                                        <div class="col m3">
                                                <input type="number" step="0.01" name=""    v-model="item_rate">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="center">
                                        <button type="submit" class="btn red">Add to Bill</button>
                                    </div>
                                </div>

                            </div>
                        </form>


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
            </div>
            
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import itemInput from './transaction/item_input.vue';
export default {
     props:{
        user:{
            type: Array
        }
    },
    components:{
        'item-input':itemInput,
    },
    data(){
        return{
            cust_no:'',
            cust_addr:'',
            cust_exists:'',
            cust_name:'',
            item_name:'',
            items:[{}],
            item_code:'',
            item_rate:'',
            item_quantity:0,

        }
    },
    methods:{
        selectItem(item){
           this.item_name=item.item_name;
           this.item_code=item.item_id;
           this.food_cat=item.cat_id;
           this.item_rate=item.item_rate;
          this.items=[{}];
          document.getElementById('item-search-text').value=item.item_name;
        },
        transactionSubmit(){
            document.getElementById("trans-submit").innerHTML='Submitting ...'
            
            document.getElementById("trans-submit").innerHTML='Done'

        },
        showItems(code,array,key){
             this.items=[{}];
            if(code===1){
               
                for(var i=0;i< array.length;i++){
                   var temp=array[i].item_name.indexOf(key);
                   if(temp>-1){
                       this.items.push(array[i])
                   }
                }
                
            }
        }
       ,
       nextItem(){

       },
        getCustomerInfo(){

            axios.post('http://127.0.0.1:8000/api/customer', {
                'mobile': this.cust_no,
            },{
                headers:[]
            }).then(
                function (response) {
                  document.getElementById("customer_name").value=response.data.customer_name;
                        document.getElementById("customer_addr").value=response.data.customer_addr;
                        document.getElementById("customer_exists").value=true;
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
