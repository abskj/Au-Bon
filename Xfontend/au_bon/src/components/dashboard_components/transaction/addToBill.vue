<template>
    <div>
         <form @submit.prevent="addToBill">
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
                                             
                                            <div class="row">
                                                 <item-input v-bind:user="user" v-on:got-items="showItems" @keyup='nextItem'></item-input>
                                            </div>
                                               <div class="row white ">
                                      
                                                    <ul >
                                                        <li v-for="item in items" @click="selectItem(item)" class="">
                                                          
                                                            {{item.item_name}}
                                                           
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
  
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
</template>

<script>
import itemInput from './item_input.vue';
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
        return {
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
       selectItem(item){
           this.item_name=item.item_name;
           this.item_code=item.item_id;
           this.food_cat=item.cat_id;
           this.item_rate=item.item_rate;
          this.items=[{}];
          document.getElementById('item-search-text').value=item.item_name;
        },
    },
    addToBill(){
        this.$emit('item-added',this.item_code,this.item_quantity);
    }
    
}
</script>

<style>
li:hover{
    background-color: rgba(0, 128, 0, 0.344);
}
</style>
