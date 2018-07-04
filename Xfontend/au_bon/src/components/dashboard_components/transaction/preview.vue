<template>
<div class="container">
    <p>Transaction ID: {{transactionId}}</p>
       <table>
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
            <tr v-for="item in this.items">
                <!-- <td>{{item.item_name}}</td> -->
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

    data:{
        items:[{}],
        bill:{},
        allItems:[{}],
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
    created: function(){
        
             axios.post('http://127.0.0.1:8000/api/get-foodItem', {
                'user_name':this.user[0]['user_name'],
                'role': this.user[0]['role'],
                'branch_id':this.user[0]['branch_id'],
            },{
                headers:[]
            }).then((response) => {
            this.allItems=response.data.data;
            this.fetchItems();
          
        }).catch(function(err){
            console.log('error');
        });
    },

    watch:{
        flag:{
            handler: function(oldVal,newVal){
                this.fetchItems();
               console.log('kfeb')
            }
        }
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
        getItemNames(){
            for (var i=0;i<this.items.length;i++){
                var x=this.items[i].item_id;
                for(var j=0;j<this.allItems.length;j++){
                    if(this.allItems[j].item_id===this.items[i].item_id){
                        this.items[i].item_name=this.allItems[j].item_name;
                        break;
                    }
                }
            }
        }
       
    }

}
</script>

<style>


</style>
