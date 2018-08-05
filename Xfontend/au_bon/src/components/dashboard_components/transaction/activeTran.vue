<template>
   <div class="col m12">   <h5 class=" center thin">Active Transactions</h5>
       <ol id="tran-list">
           <div v-for="tran in list" class="tran-tab" @click="changeActive(tran)">
           {{tran.tran_id}} for {{tran.cust_name}} at {{tran.table}}

         </div>
       </ol>
       
   </div>
</template>

<script>
export default {
    
    updated:function(){
       document.getElementById('tran-list').children[0].classList.add('hide')
    },
    props:{
        list:{
            type:Array
        }
    },
    data(){
        return {

        }
    },
    methods:{
        changeActive(tran){
            this.$emit('changeActive',tran)
        },
        startNew(){
             this.$emit('changeActive',{
                  tran_id: '',
                cust_no:'',
                cust_name:'',
                addr:'',
                steward_id: '',
                table:0,
                discount : 0.00,
                 
             })
        }
    }

}
</script>

<style>
.tran-tab {
  border-bottom: 2px solid black;
  background-color: rgba(105, 105, 63, 0.598);
  border-radius: 5px;
  position: relative;
  left: -15px;
  margin-bottom: 0.5rem;
}
.tran-tab:hover{
    box-shadow: 2px 2px grey;
}
.tran-list{
    overflow-y: scroll;
}
</style>
