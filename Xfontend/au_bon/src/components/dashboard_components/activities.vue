<template>
    <div>
        <div class="row">
            <h2 class="heading">Welcome</h2>
        </div>
        <div class="util-wrapper">
           
            <div class="row">
                
                   <div class="row">
                       <app-transaction></app-transaction>
                   </div>
                   <hr>
               <div class="col m9">
                   <div class="row container">
                        <app-restro-add v-bind:user="user"></app-restro-add>
                   </div>
                   <hr>
                   <div class="row container">
                        <app-manager-add></app-manager-add>
                   </div>
                   <hr>

               </div>
            </div>
        </div>
        <div>
            <p>in activities{{user}}</p>
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
