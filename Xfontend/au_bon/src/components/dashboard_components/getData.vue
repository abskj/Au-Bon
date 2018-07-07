<template>
    <div class="shadow" style="padding:5px 20px;">
        <form @submit.prevent="submit">
           <div class="row">
               <div class="col m4"><h3 class="heading thin">
                   Select Date
               </h3></div>
               
           </div>
            <div class="row ">
                <div class="col m5 shadow">
                    <input type="date" class="datepicker"  id="from-date" v-model="from_date">
                <label for="to-date">From Date</label>
                </div>
                <div class="col m5 offset-m1 shadow">
                    <input  type="date" class="datepicker" v-model="to_date" id="to-date">
                <label for="to-date">To Date</label>
                </div>
            </div>
            <div class="row">
                <div class="col m4"><button @click="setToday" style="margin-top:1vh;" class="btn-large teal">For Today</button></div>
                <div class="center col m5">
                    <button class="center m3 thin btn-large purple darken-4">Download</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    props:{
        user:{
            type:Array
        }
    },
    data(){
        return {
            to_date:'',
            from_date:'',
        }
    },
    
   
    methods:{
        submit(){
              axios({
              method:'post',
              url:'http://127.0.0.1:8000/api/dataDump',
              responseType:'blob',
              data:  {
                    'to_date': this.to_date,
                    'from_date' : this.from_date,
                    'user_name':this.user[0]['user_name'],
                    'branch_id':this.user[0]['branch_id'],
                }
            })
              .then(function(response) {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'report.csv');
                    document.body.appendChild(link);
                    link.click();

            });
      

        },
        setToday(){
            var today = new Date();
            var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
            console.log(date)
        }
       
        
    }

}
</script>

<style>
.datepicker{
    color: black!important;
}
.datepicker:focus{
    color: black!important;
}
</style>
