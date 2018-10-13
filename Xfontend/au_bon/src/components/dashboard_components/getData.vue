<template>
  <div class="shadow" style="padding:5px 20px;">

    <form @submit.prevent="submit">
      <div class="row">
        <div class="col m4">
          <h3 class="heading thin">
            Select Date
          </h3>
        </div>

      </div>
      <div class="row ">
        <div class="col m2 shadow">
          <input type="date" class="datepicker" id="from-date" v-model="from_date">
          <label for="to-date">From Date</label>
        </div>
        <div class="col m2 offset-m1 shadow">
          <input type="date" class="datepicker" v-model="to_date" id="to-date">
          <label for="to-date">To Date</label>
        </div>
        <div class="col m5">
           
          <div class="row">
            <div class="col m4">
            <h5 class="heading thin center">Item: </h5>
            </div>
            <div class="col m6">
          <div class="row">
             <input autocomplete="off" type="text" @keydown.enter.prevent="selectItem" @keyup.up.prevent="changeSelect(-1)" @keyup.down.prevent="changeSelect(+1)"  v-model="item_name" @focus="getItems" @blur="hideItemList" id="item-search-text">
          </div>
          <div class="row">
             <ul id="item-list" v-bind:class="listClassObject">
              
                                                        <li v-for="item,index in items" @mousedown="selectItemC(index)">
                                                         
                                                            {{item.item_name}}
                                                           
                                                        </li>
                                                        
                                                    
                                                    </ul>
          </div>
        </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col m4">
          <button @click="setToday" style="margin-top:1vh;" class="btn-large teal">For Today</button>
        </div>
        <div class="center col m5">
          <button type="submit" class="center m3 thin btn-large purple darken-4">Download</button>


        </div>
      </div>
    </form>
    <div class="row">
      <div class="col m5">
        <button @click="getStat" style="margin-top:1vh;" class="btn-large green">Get Total Sales</button>
      </div>
    </div>
    <div class="row">
      <div class="row ">
        <div class="col m4 center">
        ₹{{totalSalesVal}}
        </div>
        <div class="col m2">
            Total Sales
        </div>
      </div>
    
    <div class="row ">
      <div class="col m4 center">
        ₹{{cashVal}}
      </div>
      <div class="col m2">
          Cash Sales
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col m4 center" >
      ₹{{cardVal}}
    </div>
    <div class="col m2">
        Card Sales
    </div>
  </div>
  </div>







  </div>
</template>

<script>
  import axios from 'axios'

  import Papa from 'papaparse';
  export default {
    props: {
      user: {
        type: Array
      }
    },
    data() {
      var today = new Date();
      return {
          listClassObject:{
                hide: true,
            },
        totalSalesVal: 0.00,
        cashVal: 0.00,
        cardVal: 0.00,
        to_date: today.toISOString().substr(0, 10),
        from_date: today.toISOString().substr(0, 10),
        dataDump: '',
        select:1,
        item_name:'',
        items:[{}],
        item_code:'',
        food_cat:'',
        allItems:[{    }],
/*this.item_name=item.item_name;
           this.item_code=item.item_id;
           this.food_cat=item.cat_id;
           this.item_rate=item.item_rate;
*/
      }
    },
    components: {

    },
     watch:{
        item_name:{
           handler:  function(oldval,newval){
             while(this.items.length>0){
                 this.items.pop()
             }
             this.addDefault()
          

            for(var i=0;i< this.allItems.length;i++){
                   var temp=this.allItems[i].item_name.toLowerCase().indexOf(this.item_name.toLowerCase());
                   if(temp>-1){
                       this.items.push(this.allItems[i])
                   }
                }  
                var elements=document.getElementById("item-list").children;
                console.log(this.select-1)
                elements[this.select-1].classList.add('selected');
        }
        },
        select:{
           handler: function(oldval,newval){
               if(newval===0){
                   this.select=this.items.length;
               }
                if(newval>=this.items.length){
                    this.select=1;
                }
                 var elements=document.getElementById("item-list").children;
                for (var i=0;i<elements.length;i++){
                    elements[i].classList.remove('selected')
                }
                elements[this.select-1].classList.add('selected');
           }
        },

     },
    methods: {
      getStat() {
        axios.post(backend + '/statTransactions', {
          'to_date': this.to_date,
          'from_date': this.from_date,
          'user_name': this.user[0]['user_name'],
          'branch_id': this.user[0]['branch_id'],
        }).then(
          (response) => {
            this.totalSalesVal = response.data.total;
            this.cashVal = response.data.cash_val;
            this.cardVal = response.data.card_val;
          }
        ).catch();
      },
      submit() {
       if(this.item_code!='' && this.item_code!= -1){
           axios.post(backend + '/dataDump', {
          'to_date': this.to_date,
          'from_date': this.from_date,
          'user_name': this.user[0]['user_name'],
          'branch_id': this.user[0]['branch_id'],
          'item_code':this.item_code,
          
        }).then(
          (response) => {
            this.dataDump = response.data.data;
             this.fields = ["id",
            "updated_at",
            "tran_id",
            "cat_id",
            "item_name",
            "item_id",
            "qty",
            "rate",
            "total",
            
            "branch_id",
          
          ]
          this.generateExcel(this.fields);
          }
        )
       }
       else{
          axios.post(backend + '/dataDump', {
          'to_date': this.to_date,
          'from_date': this.from_date,
          'user_name': this.user[0]['user_name'],
          'branch_id': this.user[0]['branch_id'],
          
        }).then(
          (response) => {
            this.dataDump = response.data.data;
            this.fields = ["id",
            "updated_at",
            "tran_id",
            "cust_id",
            "bill_amount",
            "gst_comp",
            "user_name",
            "created_at",
            "steward_id",
            "discount",
            "net_billed",
            "branch_id",
            "table_no",
          ];
            this.generateExcel(this.fields);
          }
        )
       }


      },
      addDefault(){
        this.items.push({item_name:'All Items',
          item_id:'-1',
          item_rate:0,
          food_cat:0,});
      },
      setToday() {
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + (today.getDate() + 1);
        this.to_date = date;
        this.from_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        this.submit()
      },
        hideItemList(){
            this.listClassObject.hide=true;
        },
            changeSelect(x){
                this.listClassObject.hide=false;
               
               this.select=this.select+x;
               
            },
             getItems(){
               
            
             axios.post(backend+'/get-foodItem', {
                'user_name':this.user[0]['user_name'],
                'role': this.user[0]['role'],
                'branch_id':this.user[0]['branch_id'],
            },{
                headers:[]
            }).then((response) => {
                this.code=response.data.code;
            this.allItems=response.data.data;
            this.listClassObject.hide=false;

        }

            ).catch(function (error) {
                console.log(error);
            })
        },
        isSelected(index){
            if((index+1)===this.select){
                return true;
            }
            else{
                return false;
            }
        },
        selectItemC(index){
            this.select=index+1;
            this.selectItem();
        },
      
       selectItem(){
           var item=this.items[this.select-1];
           this.item_name=item.item_name;
           this.item_code=item.item_id;
           this.food_cat=item.cat_id;
           this.item_rate=item.item_rate;
          this.items=[{}];
          document.getElementById('item-search-text').value=item.item_name;
          this.listClassObject.hide=true;
        },
      generateExcel(fields_info) {
        //  console.log(this.dataDump[1])
        let data1 = this.dataDump
        var csv = Papa.unparse({
          fields: fields_info,
          data: data1,
          config: {
            quotes: false,
            quoteChar: '"',
            escapeChar: '"',
            delimiter: ",",
            header: true,
            newline: "\n"
          }
        });


      
        var blob = new Blob([csv]);
        if (window.navigator.msSaveOrOpenBlob) // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
          window.navigator.msSaveBlob(blob, "AU-BON_data.csv");
        else {
          var a = window.document.createElement("a");
          a.href = window.URL.createObjectURL(blob, {
            type: "text/plain"
          });
          a.download = "AU-BON_data.csv";
          document.body.appendChild(a);
          a.click(); // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
          document.body.removeChild(a);


        }
      }
    }
  }
</script>

<style>
  .datepicker {
    color: black !important;
  }

  .datepicker:focus {
    color: black !important;
  }
  .selected{
    background-color: rgba(97, 252, 120, 0.905);
}
</style>