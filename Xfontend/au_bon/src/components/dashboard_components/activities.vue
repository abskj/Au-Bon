<template>
    <div>
       
        <div class="util-wrapper">
           
<router-view v-bind:loginControl="loginControl" v-on:logout="logout" v-bind:user='user'></router-view>

    </div>
    </div>
</template>

<script>
import Transaction from './transaction.vue';
import RestroAdd from './add_restro.vue';
import MangAdd from './add_manager.vue';
import BranchAdd from './add_branch.vue';
export default {
    components:{
        'app-restro-add':RestroAdd,
        'app-manager-add':MangAdd,
        'app-transaction' :Transaction,
        'app-branch-add':BranchAdd,
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
.util-wrapper{
    padding: 1em;
}
</style>
