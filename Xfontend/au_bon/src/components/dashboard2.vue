<template>
    <div>
        <navbar></navbar>
    <div class="row">
        <div class="col m2 hide-on-small-only">
            <sidebar class="red"></sidebar>
        </div>
        <div class="col m10">
            <activities></activities>
            
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
}
}
</script>


<style>

</style>
