<template>
    <div id="modify-items">
        <h4>Edit Items</h4>
      
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
               <table>
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr v-for="item in items">
                    <td><input @change="nameChanged(item,$event)" class="item-detail" type="text" name="" :value="item.item_name" id="" disabled></td>
                    <td>{{item.cat_id}}</td>
                    <td><input @change="rateChanged(item,$event)" class="item-detail" type="number" step="0.01" name="" :value="item.item_rate" id="" disabled></td>
                   
                    <td>
                        <div class="switch">
                        <label>
                        Off
                        <input type="checkbox" @change="change(item)" :checked="item.status == 1" disabled>
                        <span class="lever"></span>
                        On
                        </label>
                    </div>
                    </td>
                    <td>
                        <button @click.prevent="enableInput($event)" class="btn">Edit</button>
                    </td>
                    <td>
                        <button @click="updateItem(item,$event)" class="btn">Update</button>
                    </td>
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
                axios.post(backend+'/allfoodItem',{
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
        updateItem(item, evt){
            axios.put(backend+'/foodItem',{
                 'user_name' : this.user[0]['user_name'],
            'role' :this.user[0]['role'],
            'branch_id' :this.user[0]['branch_id'],
              'cat_id' : item.cat_id,
            'item_id' : item.item_id,
            'branch_id' :item.branch_id,
            'HSN_code': item.HSN_code,
            'SGST' :item.SGST,
            'CGST' :item.CGST,
            'item_name' :item.item_name,
            'item_rate' :item.item_rate,
            'status' : item.status,
            }).then(
                (response) =>{
                   M.toast({html: 'Item '+item.item_name+' Updated' });
                   this.disableInput(evt);
                  
                }
            ).catch(
                (err)=>{
                     M.toast({html: 'Item '+item.item_name+' Could not be Updated' })
                }
            )
        },
        change(item){
            if(item.status == 1){
                item.status = 0;
            }else{
                item.status = 1;
            }
        },
        rateChanged(item, evt){
            item.item_rate=evt.target.value
        },
        nameChanged(item, evt){
            item.item_name=evt.target.value
        },
        enableInput(el){
            console.log(el.target.parentElement.parentElement.innerHTML);
            var x = el.target.parentElement.parentElement.getElementsByTagName("input");
            console.log(x)
           var l = x.length;
            for (var i = 0; i < l; i++) {
               x[i].disabled=false;
            } 

        },
         disableInput(el){
            console.log(el.target.parentElement.parentElement.innerHTML);
            var x = el.target.parentElement.parentElement.getElementsByTagName("input");
            console.log(x)
           var l = x.length;
            for (var i = 0; i < l; i++) {
               x[i].disabled=true;
            } 

        }
    }

}
</script>

<style>
.item-detail{
        color:black!important;
    height: 0.9em!important;
    margin-bottom: 1px;
    /* border:1px solid grey!important; */

    background-color: rgba(214, 214, 214, 0.316)!important;
    border-radius:2px!important; 
    padding: 3px!important;
}

</style>
