<template>
    <div>
        <h2 class="heading">Welcome</h2>
        <div class="container">
           
            <div class="row">
               <div class="col m9">
                   <div class="row container">
                        <app-restro-add></app-restro-add>
                   </div>
                   <hr>
                   <div class="row container">
                        <app-manager-add></app-manager-add>
                   </div>

               </div>
            </div>
        </div>
    </div>

</template>

<script>
import RestroAdd from './add_restro.vue';
import MangAdd from './add_manager.vue';
export default {
    components:{
        'app-restro-add':RestroAdd,
        'app-manager-add':MangAdd,
    }

}
</script>

<style>

</style>
