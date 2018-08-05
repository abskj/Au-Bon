<template>
    <div style="margin-top:0px">
       <div class="row" style="margin-top:0px">
            <h4 class="center">Transactions History</h4>
            <form @submit.prevent="getTrans(mainUrl)">
               <div class="row">
                   <div class="col m3">
                       <label for=""> From</label><input v-model="beginDate" type="date" name="" id="">
                   </div>
                   <div class="col m3">
                        <label for=""> To</label><input v-model="endDate" type="date" name="" id="">
                   </div>
                   <div class="col m4">
                       <div class="input-field">
                           <input type="number" class="validate" id="search-query">
                           <label for="search-query">Search by Customer Phone Number</label>
                       </div>
                   </div>
               </div>
               <div class="row">
                  
                   <div class="col m4"></div>
                   <div class="col m4">
                       <button class="btn center green" type="submit">
                           Run Query
                       </button>
                   </div>
               </div>
                
            </form>
            <div>
                <ul>
                <li v-for="tran in transactions">
                    <p>
                        {{tran.tran_id}}
                    {{tran.created_at}}
                    {{tran.bill_amount}}
                    {{tran.cust_id}}
                    {{tran.net_billed}}
                    </p>
                </li>
            </ul>
            </div>
            <div class="row">
               <div class="center">
                    <button class="btn" :disabled="!pagination.prev_page_url" @click="getTrans(pagination.prev_page_url)">
                    Previous
                </button>
                <span>
                    {{ pagination.current_page}} of {{pagination.last_page}}
                </span>
                 <button class="btn" :disabled="!pagination.next_page_url" @click="getTrans(pagination.next_page_url)">
                    Next
                </button>
               </div>
            </div>
           
           
       </div>
    </div>
</template>

<script>
// $('.datepicker').datepicker();
import axios from 'axios';
export default {
     props:{
        user:{
            type: Array
        },
    },
    data(){
        return{
            beginDate:"",
            endDate:"",
            pagination:{
                'prev_page_url':'',
                'next_page_url':'',
                'current_page':'',
                'last_page':'',
            },
           transactions:[{}],
           mainUrl:backend+'/retrieveTransactions',

        }
    },
    created:function(){
    
    },
    methods:{
      getTrans(url){
          axios.post(url,{
               'username' :this.user[0]['user_name'],
                'branch_id':this.user[0]['branch_id'],
                'type':1
          }).then(
              (response) =>{
                 this.makePaginate(response.data.data);
                 this.fillData(response.data.data.data);
              }
          )
      },


      makePaginate(data){
          
          this.pagination.prev_page_url=data.prev_page_url;
          this.pagination.next_page_url=data.next_page_url;
          this.pagination.current_page=data.current_page;
          this.pagination.last_page=data.last_page;


      },

      fillData(data){
          this.transactions=[];
          this.transactions=data;
      }  
    }

}
</script>

<style >
div:hover{
    /* border:1px dashed blue; */
}
</style>
