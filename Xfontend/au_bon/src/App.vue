<template>
  <div id="app">
   <router-view @success="test"></router-view>
   
  </div>
</template>

<script>
import loginComponent from './components/login.vue';
export default {
 methods:{
   test(){
     console.log('kjgekhgbke');
   }
 }

}
</script>
