<template>
    <div>
        <h4>Edit Items</h4>
        {{cat_id}}
    <div class="row">
       
          <div class="col m3">
              <p>Choose Category</p>
          </div>
          <div class="col m4">
               <select  @focus="getCat" class="browser-default" v-model="cat_id" id="">
               <option value="">All</option>
               
               <option v-for="cat in categories" :value="cat.cat_id">{{cat.cat_name}}</option>
           </select>
          </div>
          <div class="col m2">
            <div class="center">
                  <button @click.prevent="getItems" class="btn green">Get Items</button>
            </div>
          </div>
          <div class="row">
               <table >
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                <tr v-for="item in items">
                    <td>{{item.item_name}}</td>
                    <td>{{item.cat_id}}</td>
                    <td>{{item.item_rate}}</td>
                    <td>{{item.status}}</td>
                </tr>
               
                </table> 
          </div>
      
    </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
     props: {
        user: {
            type: Array
        }
    },
    data(){
        return{
            categories:[{}],
            items:[{}],
            cat_id:'',


        }
    },
    methods:{
        getCat(){
            axios.post(backend+'/get-foodCategory',{
            'user_name' : this.user[0]['user_name'],
            'role' :this.user[0]['role'],
            'branch_id' :this.user[0]['branch_id'],
            }).then(
                (response) =>{
                    this.categories=response.data.data
                }
            )
        },
        getItems(){
            this.items=[{}]
            if(!this.cat_id){
                axios.post(backend+'/get-foodItem',{
                  'user_name' : this.user[0]['user_name'],
            'role' :this.user[0]['role'],
            'branch_id' :this.user[0]['branch_id'],
              }).then(
                (response)=>{
                    this.items=response.data.data;
                }
            ).
            catch(err =>{
                console.log(err);
            })
            }
            else{///foodItemsByCat
                 axios.post(backend+'/foodItemsByCat',{
                  'user_name' : this.user[0]['user_name'],
            'role' :this.user[0]['role'],
            'branch_id' :this.user[0]['branch_id'],
            'cat_id' :this.cat_id,
              }).then(
                (response)=>{
                    this.items=response.data.data;
                }
            ).
            catch(err =>{
                console.log(err);
            })
            }
        },
        updateItem(item){
            axios.put(backend+'/foodItem',{

            })
        }
    }

}
</script>

<style>

</style>
