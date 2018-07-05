<template>
    <div>
       
        <div class="util-wrapper">
           
<router-view  v-bind:user='user'></router-view>
    </div>
    </div>
</template>

<script>
import Transaction from './transaction.vue';
import RestroAdd from './add_restro.vue';
import MangAdd from './add_manager.vue';
export default {
    components:{
        'app-restro-add':RestroAdd,
        'app-manager-add':MangAdd,
        'app-transaction' :Transaction,
    },
    props: {
        user: {
            type: Array
        }
    }

}
</script>

<style>
.util-wrapper{
    padding: 1em;
}
</style>
