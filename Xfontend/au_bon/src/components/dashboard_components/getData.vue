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
        <div class="col m5 shadow">
          <input type="date" class="datepicker" id="from-date" v-model="from_date">
          <label for="to-date">From Date</label>
        </div>
        <div class="col m5 offset-m1 shadow">
          <input type="date" class="datepicker" v-model="to_date" id="to-date">
          <label for="to-date">To Date</label>
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
        totalSalesVal: 0.00,
        cashVal: 0.00,
        cardVal: 0.00,
        to_date: today.toISOString().substr(0, 10),
        from_date: today.toISOString().substr(0, 10),
        dataDump: '',

      }
    },
    components: {

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
        axios.post(backend + '/dataDump', {
          'to_date': this.to_date,
          'from_date': this.from_date,
          'user_name': this.user[0]['user_name'],
          'branch_id': this.user[0]['branch_id'],
        }).then(
          (response) => {
            this.dataDump = response.data.data;
            this.generateExcel();
          }
        )


      },
      setToday() {
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + (today.getDate() + 1);
        this.to_date = date;
        this.from_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        this.submit()
      },
      generateExcel() {
        //  console.log(this.dataDump[1])
        let data1 = this.dataDump
        var csv = Papa.unparse({
          fields: ["id",
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
          ],
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


        console.log(csv)
        var blob = new Blob([csv]);
        if (window.navigator.msSaveOrOpenBlob) // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
          window.navigator.msSaveBlob(blob, "filename.csv");
        else {
          var a = window.document.createElement("a");
          a.href = window.URL.createObjectURL(blob, {
            type: "text/plain"
          });
          a.download = "filename.csv";
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
</style>