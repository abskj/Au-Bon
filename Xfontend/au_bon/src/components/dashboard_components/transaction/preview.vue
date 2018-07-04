<template>
<div class="">
    <p>Transaction ID: {{transactionId}}</p>
       <table class="striped">
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Code</th>
              <th>Item Price</th>
              <th>Quantity</th>
              <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="item in items">
                <td>{{item.item_name}}</td>
                <td>{{item.item_id}}</td>
                <td>{{item.rate}}</td>
                <td>{{item.qty}}</td>
                <td>{{item.total}}</td>
            </tr>
        </tbody>
       </table>
</div>
</template>

<script>
import axios from 'axios';
export default {

    data(){
        return {
        items:[{}],
        bill:{},
        allItems:[{}],
    }
    },
    props:{
        transactionId:{
            type:String
        },
        flag:{
            type:Number
        },
        user:{
            type: Array
        }

    },
    updated: function(){
        
          this.fetchItems();
    },

    methods:{
        fetchItems(){
            axios.post('http://127.0.0.1:8000/api/get-transaction',{
                'transaction_id' : transactionId,
            },{
                headers:[
                   
                ]
            }).then(
                (response) => {
                    this.items=response.data.transactions;
                    console.log(this.items)
                    this.bill=response.data.bill;
                   //  this.getItemNames();

                }
            ).catch(function(error){
                console.log(error)
            })
           
        },
       
    }

}
</script>

<style>


</style>
