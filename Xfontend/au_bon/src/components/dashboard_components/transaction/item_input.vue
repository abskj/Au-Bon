<template>
     <input type="text" v-model="item_name" @keypress.enter.prevent="getItems" id="item-search-text">
</template>

<script>
import axios from 'axios';

export default {
    props:{
        user:{
            type: Array
        }
    },
methods:{
     getItems(){
            
             axios.post('http://127.0.0.1:8000/api/get-foodItem', {
                'user_name':this.user[0]['user_name'],
                'role': this.user[0]['role'],
                'branch_id':this.user[0]['branch_id'],
            },{
                headers:[]
            }).then(response => {this.code=response.data.code,
            this.items=response.data.data,
            this.key=document.getElementById('item-search-text').value,
        this.$emit('got-items',this.code,this.items,this.key)
        }

            ).catch(function (error) {
                console.log(error);
            })
        },
       
}
}
</script>


<style>

</style>
