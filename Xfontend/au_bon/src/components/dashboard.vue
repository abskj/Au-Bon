<template>
    <div>
        <h1 class="header">Welcome to Dashboard.You will find everything you need here</h1>
    <div class="row">
        <div class="col m6 s12">
            <div class="container">
                <db-add-user></db-add-user>
            </div>
        </div>
        <div class="col m6 s12">
            <div class="container">
                <db-show-users></db-show-users>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import addUser from './addUser.vue';
import showUsers from './showUsers.vue';

export default {
    components:{
        'db-add-user':addUser,
        'db-show-users':showUsers
    }

}
</script>

<style>

</style>
