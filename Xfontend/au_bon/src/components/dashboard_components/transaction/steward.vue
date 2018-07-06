<template>
     <div class="row">
                    <div class="col m4 label">
                            Steward:
                    </div>
                    <div class="col m6">
                            
                        <div class="row">
                                    <input autocomplete="off" type="text" @keydown.enter.prevent="selectsteward" @keyup.up.prevent="changeSelect(-1)" @keyup.down.prevent="changeSelect(+1)"  v-model="steward_name" @focus="getstewards" @blur="hidestewardList" id="steward-search-text">
                        </div>
                            <div class="row white ">
                    
                                <ul id="steward-list" v-bind:class="listClassObject">
                                    <li v-for="x,index in stewards" @mousedown="selectstewardC(index)">
                                        
                                        {{x.name}}
                                        
                                    </li>
                                
                                </ul>
                            </div>

                    </div>
     </div>
</template>

<script>
import axios from 'axios';
export default {
    props:{
        user:{
            type: Array
        },
        flag:{
            type: Number
        },
        selectFlag:{
            type:String
        }
    },
    data() {
        return {

            listClassObject: {
                hide: true,
            },
            select: 1,
            steward_name: '',
            stewards: [{}],
            steward_id: '',

            allstewards: [{}],
        }
    },
    watch: {
        flag:{
            handler: function(oldval, newval){
                this.listClassObject.hide=true;
                this.select= 1;
                this.steward_name= '';
                this.stewards= [{}];
                this.steward_id= '';   
                this.allstewards= [{}]
            }
        },
        steward_name: {
            handler: function (oldval, newval) {
                while (this.stewards.length > 0) {
                    this.stewards.pop()
                }
                console.log('name changed')
                console.log(this.allstewards)

                for (var i = 0; i < this.allstewards.length; i++) {
                    var temp = this.allstewards[i].name.toLowerCase().indexOf(this.steward_name.toLowerCase());
                    if (temp > -1) {
                        this.stewards.push(this.allstewards[i])
                    }
                }
                var elements = document.getElementById("steward-list").children;
                console.log(this.select - 1)
                elements[this.select - 1].classList.add('selected');
            }
        },
        select: {
            handler: function (oldval, newval) {
                if (newval === 0) {
                    this.select = this.stewards.length;
                }
                if (newval >= this.stewards.length) {
                    this.select = 1;
                }
                var elements = document.getElementById("steward-list").children;
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList.remove('selected')
                }
                elements[this.select - 1].classList.add('selected');
            }
        },
        selectFlag: {
            handler: function(o,n){
               
               
            }
              
        }
    },
    methods: {
        hidestewardList() {
            this.listClassObject.hide = true;
        },
        changeSelect(x) {
            this.listClassObject.hide = false;
            console.log(x)
            this.select = this.select + x;

        },
        getstewards() {
            axios.post('http://127.0.0.1:8000/api/get-steward', {

                'branch_id': this.user[0]['branch_id'],
            }, {
                headers: []
                 }).then((response) => {
                    this.code = response.data.code;
                    this.allstewards = response.data.data;
                    console.log(this.allstewards)
                    this.listClassObject.hide = false;
                }
            ).catch(function (error) {
                console.log(error);
            })
        },
        isSelected(index) {
            if ((index + 1) === this.select) {
                return true;
            }
            else {
                return false;
            }
        },
        selectstewardC(index) {
            this.select = index + 1;
            this.selectsteward();
        },
       
        selectsteward() {
            var steward = this.stewards[this.select - 1];
            this.steward_name = steward.name;
            this.steward_id = steward.id;

            this.stewards = [{}];
            document.getElementById('steward-search-text').value = steward.name;
            this.listClassObject.hide = true;
            this.$emit('steward-added', this.steward_id, this.steward_name);
        },



    }
}
</script>

<style>
    .selected{
        background-color: rgba(97, 252, 120, 0.905);
    }

</style>
