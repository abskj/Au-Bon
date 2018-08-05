<template>
    <div>
        <navbar v-on:logout="logout"  v-bind:user="user"></navbar>
    <div class="row" style="margin-bottom:0px">
        <div class="col m2 hide-on-small-only " style="padding-left:0px">
            <sidebar class="grey darken-4"></sidebar>
        </div>
        <div class="col m10">
            <activities  v-bind:loginControl="loginControl" v-bind:user="user"></activities>
       
        </div>
    </div>
    <footerr></footerr>
    </div>
</template>

<script>
import Nav from './dashboard_components/navbar.vue';
import Sidebar from './dashboard_components/sidebar.vue';
import Activities from './dashboard_components/activities.vue';
import Foot from './footer.vue';
export default {
components:{
    'navbar': Nav,
    'sidebar': Sidebar,
    'activities': Activities,
    'footerr' :Foot,
},
props: {
    user: {
        type: Array
    },
    loginControl:{
            type: Boolean
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
