<template>
    <div>
        
  <nav>
    <div class="nav-wrapper purple darken-4 ">
      <a href="#" class="brand-logo thin" style="padding:2px;padding-left:5px;">AU-BON</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li v-if=""><router-link to="/history">View Transactions</router-link></li>
        <li v-if="isAdmin" ><router-link to="/restro-add">Add Restro</router-link></li>
        <li ><router-link to="/">Transaction</router-link></li>
        <li v-if="isAdmin"><router-link to="/branch-add/">Add Branch</router-link></li>
        <li><router-link to="/cat-add/">Add Food Category</router-link></li>
        <li><router-link to="/item-add/">Add Food Item</router-link></li>
        <li><router-link to="/data/">Download Data</router-link></li>
        <li><router-link to="/steward-add/">Create Steward</router-link></li>
        <li ><router-link to="/staff-add/">Create Staff</router-link></li>
        <li v-if="isAdmin"><router-link to="/manager-add/">Create Manager</router-link></li>
        <li @click="logout">Logout</li>
       
      </ul>
    </div>
  </nav>
 

  <!--Side nav</comment-->
      
    </div>
</template>

<script>
 
export default {
  props: {
    user: {
        type: Array
    }
},
computed: {
  isAdmin: function () {
    if(this.user[0]['role']===0){
      return true;
    }
    else{
    return false;
    }
  }
},
data(){
return {
 
}
},
methods:
{
  logout(){
    this.$emit('logout')
  }
}
}
</script>

<style>

</style>
