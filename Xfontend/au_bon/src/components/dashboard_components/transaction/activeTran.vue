<template>
   <div>
       <div v-for="tran in list" class="tran-tab" @click="changeActive(tran)">
           {{tran.tran_id}} for {{tran.cust_name}}

         </div>
         <div @click="startNew()">
             New
         </div>
   </div>
</template>

<script>
export default {
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
</style>
