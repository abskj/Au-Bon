<template>
    <div>
        <navbar v-on:logout="logout"></navbar>
    <div class="row" >
        <div class="col m2 hide-on-small-only " style="padding-left:0px">
            <sidebar class="grey darken-4"></sidebar>
        </div>
        <div class="col m10">
            <activities  v-bind:user="user"></activities>
            
        </div>
    </div>
   
    </div>
</template>

<script>
import Nav from './dashboard_components/navbar.vue';
import Sidebar from './dashboard_components/sidebar.vue';
import Activities from './dashboard_components/activities.vue';
export default {
components:{
    'navbar': Nav,
    'sidebar': Sidebar,
    'activities': Activities,
},
props: {
    user: {
        type: Array
    }
},
methods:{
      logout(){
        
    this.$emit('logout')
     }
    }

}
</script>


<style>

</style>
