<template>
  <div id="app">
   <login-form></login-form>
  </div>
</template>

<script>
import loginComponent from './components/login.vue';
export default {
 
  data () {
    return {
     
    }
  },
  components:{
    'login-form':loginComponent
  }
}
</script>
