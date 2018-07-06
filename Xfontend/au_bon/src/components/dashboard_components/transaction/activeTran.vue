<template>
   <div class="col m6">   <h4 class="heading center thin">Active Transactions</h4>
       <ol id="tran-list">
           <div v-for="tran in list" class="tran-tab" @click="changeActive(tran)">
           {{tran.tran_id}} for {{tran.cust_name}}

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
}
.tran-tab:hover{
    box-shadow: 2px 2px grey;
}
</style>
