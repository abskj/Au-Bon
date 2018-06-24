<template>
    <div id="trans">
        <div class="row">
            <h4 class="heading container">
            Transaction
        </h4>
        </div>
        <div class="row ">
            <div class="col s12 m6">
                <form action="" class="" @submit.prevent="transactionSubmit">
                    <div class="row ">
                        <div class="col m3 label">
                            Customer Name:
                        </div>
                        <div class="col m9">
                            <input type="text" name="" id="" v-model="customer_name">
                        </div>
                    </div>
                    
                    <div class="row ">
                        <div class="col m3 label">
                            Customer Mobile Number:
                        </div>
                        <div class="col m9">
                            <input type="number" minlength="10" name="" id="" v-model="customer_no">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m3 label">
                            Customer Address:
                        </div>
                        <div class="col m9">
                            <input type="text" minlength="10" maxlength="200" name="" id="" v-model="customer_addr">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m3 label">
                            Table:
                        </div>
                        <div class="col m3">
                            <input type="text" minlength="10" maxlength="200" name="" id="" v-model="customer_table">
                        </div>
                    </div>
                    <div class="row green lighten-3">
                        <form id="" action="">
                            <div class="col m12">
                                
                                
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Food Category:
                                      </div>
                                        <div class="col m3">
                                                <input disabled type="text" minlength="10" maxlength="200" name="" id=""   v-mod el="food_cat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                       <div class="col m2 label">
                                              Item:
                                      </div>
                                        <div class="col m4">
                                              <input @focus="getItems" type="text" id="items" class="autocomplete">
                                             
  
                                        </div>
                                        <div class="col m6">
                                            <div class="row">
                                       <div class="col m2 label">
                                              Code:
                                      </div>
                                        <div class="col m4">
                                               <input disabled type="text" v-model="item_code">
  
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Item Quantity:
                                      </div>
                                        <div class="col m3">
                                                <input type="number"  name="" id=""   v-model="item_quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Item Rate:
                                      </div>
                                        <div class="col m3">
                                                <input type="number" step="0.01" name="" id=""   v-model="item_rate">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="center">
                                        <button type="submit" class="btn red">Add to Bill</button>
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                                 <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Discount Rate:
                                      </div>
                                        <div class="col m3">
                                                <input type="number" step="0.01" name="" id=""   v-model="discount_rate">
                                        </div>
                                        <div class="col m3">Customer Type</div>
                                        <div class="col m3">
                                            <select class="browser-default" name="" id="">
                                                <option value="">Student</option>
                                                <option value="">Special</option>
                                                <option value="">Student</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                   
                    <div class="row">
                        <div class="center">
                            <button id="trans-submit" type="submit" class="btn waves green">Finish Transaction</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s12 m6 container">
                <div class="center">
                    <h3 class="heading">Preview</h3>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    methods:{
        transactionSubmit(){
            document.getElementById("trans-submit").innerHTML='Submitting ...'
            for(i=0;i<50;i++){

            }
            document.getElementById("trans-submit").innerHTML='Done'

        },
        getItems(){
           
                    var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
            ];
            $('#items').autocomplete({
            source: availableTags
            });
            

         }
    }

}
</script>

<style>
.container{
    border: 2px blueviolet solid;
}
#trans input{
    color:black!important;
    height: 1.2em;
    margin-bottom: 1px;
}

#trans input:focus{
    color:black!important;
}
#trans form{
    margin: 10px;
}
#trans * .row
{
    margin-bottom: 10px;
}
.label{
    
    font-weight: 600;
}
#trans-submit{
    
}
</style>
