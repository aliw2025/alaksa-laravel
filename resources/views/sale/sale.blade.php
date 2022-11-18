@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form class="" method="POST" target="_blank" autocomplete="on" action="{{ $type==1?route('sale.store'):route('post-return') }}">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div
                                        class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                <h3 class="ms-0 text-primary invoice-logo">Alpha Digital</h3>
                                            </div>
                                            <p class="card-text mb-25">Office 149,Mustafa plaza</p>
                                            <p class="card-text mb-25">Ring Road Peshawar, PK</p>
                                            <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>

                                            <div class="mt-2 d-flex align-items-center justify-content-between">
                                                <span class="title me-1">Marketing Officer: </span>
                                                @if ($type == 1)
                                                    <div style="width: 11.21rem; max-width:11.21rem;"
                                                        class="align-items-center">
                                                        <input name="mar_of_id" id="mar_of_id"s class="form-control"
                                                            placeholder="Name" type="hidden">
                                                        <input name="mar_of_name" onkeyup="getMUserByName()"
                                                            id="mar_of_name" class="form-control" placeholder="Name"
                                                            type="text">
                                                        <div class="list-type" id="mar_list"
                                                            style="position: absolute; z-index: 1;" class="card mb-4">
                                                            <div id="mar_list_body" class="list-group">

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input id="mar_of_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                                @endif

                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Recovery Officer: </span>
                                                @if ($type == 1)
                                                    <div style="width: 11.21rem; max-width:11.21rem;"
                                                        class="align-items-center">
                                                        <input name="rec_of_id" id="rec_of_id"s class="form-control"
                                                            placeholder="Name" type="hidden">
                                                        <input name="rec_of_name" onkeyup="getRUserByName()"
                                                            id="rec_of_name" class="form-control" placeholder="Name"
                                                            type="text">
                                                        <div class="list-type" id="rec_list"
                                                            style="position: absolute; z-index: 1;" class="card mb-4">
                                                            <div id="rec_list_body" class="list-group">

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input  id="rec_of_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                                @endif

                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="title">Sale Type:</span>
                                                @if ($type == 1)
                                                    <div style="width: 11.21rem; max-width:11.21rem; "
                                                        class="align-items-center">
                                                        <select id="sale_type" name="sale_type" class="form-select"
                                                            aria-label="Default select example">

                                                            <option value="1">Instalments</option>
                                                            <option value="2">Cash</option>

                                                        </select>
                                                    </div>
                                                @else
                                                    <input name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                                @endif


                                            </div>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf
                                                
                                                @if($type == 2)
                                               
                                                <input id="sale_id"  name="sale_id" type="hidden"
                                                    class="form-control " placeholder="">
                                                @endif
                                                <h4 class="invoice-title"> {{ $type == 1 ? 'Sale #' : 'Search Sale #' }}</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    
                                                    <input id="search_inv" @if ($type == 1) disabled @endif
                                                        name="purchaseId" type="text"
                                                        class="form-control invoice-edit-input" placeholder="">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                @if ($type == 1)
                                                    <input name="sale_date" type="text"
                                                        class="form-control invoice-edit-input date-picker flatpickr-input"
                                                        readonly="readonly">
                                                @else
                                                    <input id = "sale_date" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                                @endif
                                               
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Investor:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    @if ($type == 1)
                                                        <select name="investor_id"
                                                            class=" select2 select2-hidden-accessible form-control invoice-edit-input"
                                                            id="select2-basic" datas-select2-id="select2-basic"
                                                            tabindex="-1" aria-hidden="true">

                                                            @foreach ($investors as $investor)
                                                                <option value="{{ $investor->id }}">
                                                                    {{ $investor->investor_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    @else
                                                        <input id="investor_name" name="purchase_date" type="text"
                                                            class="form-control invoice-edit-input" readonly="readonly">
                                                    @endif


                                                </div>
                                            </div>
                                            <div class=" mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer ID:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    @if ($type == 1)
                                                        <input name="customer_id" onkeyup="getCustomerById()"
                                                            id="customer_id" class="form-control" placeholder="ID"
                                                            type="text">
                                                    @else
                                                        <input id="customer_id" name="purchase_date" type="text"
                                                            class="form-control invoice-edit-input" readonly="readonly">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer Name:</span>
                                                @if ($type == 1)
                                                    <div style="width: 11.21rem; max-width:11.21rem; "
                                                        class="align-items-center">
                                                        <input name="customer_name" onkeyup="getByName()"
                                                            id="customer_name" class="form-control"
                                                            placeholder="Customer Name" type="text">
                                                        <div class="list-type" id="customer_list"
                                                            style="position: absolute; z-index: 1;" class="card mb-4">
                                                            <div id="customer_list_body" class="list-group">

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input id="customer_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Header ends -->
                                <hr class="invoice-spacing">
                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
                                    <form class="source-item">
                                        @if ($type == 1)
                                            )
                                            <div data-repeater-list="group-a">
                                                <div class="repeater-wrapper" data-repeater-item="">
                                                    <div class="row">

                                                        <div class="col-12  product-details-border position-relative pe-0">
                                                            <div class="row py-2">
                                                                <div class="col-1 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">id</p>
                                                                    <input name="item_id" id="item_id" type="number"
                                                                        class="form-control" value=""
                                                                        placeholder="id">
                                                                </div>
                                                                <div class="col-3 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">Item Name
                                                                    </p>
                                                                    <input onkeyup="getItems()" id="item_name"
                                                                        name="item_name" type="text"
                                                                        class="form-control" placeholder="Item Name">
                                                                    <div class="list-type" id="list"
                                                                        style="position: absolute; z-index: 1;"
                                                                        class="card mb-4">
                                                                        <div id="listBody" class="list-group">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">Selling
                                                                        Price
                                                                    </p>
                                                                    <input name="selling_price"
                                                                        onkeyup="calculateInstallments()"
                                                                        id="selling_price" type="number"
                                                                        class="form-control" value=""
                                                                        placeholder="Selling Price">
                                                                </div>

                                                                <div id="plan_div" class="col-2 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">Plan
                                                                        (Months)
                                                                    </p>
                                                                    <input name="plan"
                                                                        onkeyup="calculateInstallments()" id="plan"
                                                                        type="number" class="form-control"
                                                                        value="" placeholder="Months">
                                                                </div>

                                                                <div id="markup_div" class="col-2 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">MarkUp</p>
                                                                    <input name="markup"
                                                                        onkeyup="calculateInstallments()" id="markup"
                                                                        type="number" class="form-control"
                                                                        value="" placeholder="%">
                                                                </div>
                                                                <div id="discount_div" class="col-2 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">Trade
                                                                        Discount
                                                                    </p>
                                                                    <input name="trade_discount" id="trade_discount"
                                                                        type="number" class="form-control"
                                                                        value="" placeholder="Discount">
                                                                </div>
                                                            </div><s></s>

                                                        </div>
                                                    </div>
                                                    <div id="instalment_sec">
                                                        <div class="row mt-1">
                                                            <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-6  mt-1">
                                                                        <p>Total Sum :</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input id="total_sum"
                                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                            name="total_sum" class="form-control"
                                                                            value="0">
                                                                        {{-- <p id="total_sum_label"> 0</p> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      
                                                        <div class="row ">
                                                            <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-6  mt-1">
                                                                        <p>Down Payment :</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input  onkeyup="reAdjust()" id="down_payment"
                                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                            name="down_payment" class="form-control"
                                                                            value="0">
                                                                        {{-- <p id="down_payment_label"> 0</p> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-5">
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-6  mt-1">
                                                                        <p>Down Payment Paid :</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input name="down_payment_paid" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                                <div class="row d-flex align-items-center ">
                                                                    <div class="col-6 mt-1">
                                                                        <p>instalments :</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input disabled id="instalments"
                                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                            name="instalments" class="form-control"
                                                                            value="0">
                                                                        {{-- <p id="instalments_label"> 0</p> --}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                                <div class="row d-flex align-items-center">
                                                                    <div  class="col-6 mt-1">
                                                                        <p>instalments per Month :</p>
                                                                    </div>
                                                                    <div class="col-6  ">
                                                                        <input onkeyup="reAdjust2()"id="per_month"
                                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                            name="instalment_per_month"
                                                                            class="form-control" value="0">
                                                                        {{-- <p id="per_month_label"> 0</p> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @else
                                            <table id="investor-table" class="table">
                                                <thead class="thead-dark">
                                                    <tr style="background-color:red !important;">
                                                        <th style="width: 2px !important">#</th>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Item Name</th>
                                                        <th scope="col">Selling Price</th>
                                                        <th scope="col">Plan</th>
                                                        <th scope="col">Marup</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="sale_body" id="sale_body">



                                                </tbody>
                                            </table>
                                        @endif

                                    </form>
                                </div>
                                <!-- Product Details ends -->

                                <!-- Invoice Total ends -->
                                <hr class="invoice-spacing mt-0">

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                        </div>
                                    </div>
                                    <!-- Invoice Note ends -->
                                </div>
                                @if($type==1)
                                <div class="row p-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">Save</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row p-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            {{-- onclick="returnSale()" --}}
                                            <button id="retBtn" disabled  class="btn btn-primary me-2">Return</button>
                                           
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </form>
                    </div>
            </section>
        </div>
    </div>

    <script src="{{ url('/resources/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ url('/resources/js/scripts/forms/form-select2.min.js') }}"></script>
    <script src="{{ url('/resources/js/scripts/pages/app-invoice.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2-selection__arrow').hide();
            $('#instal').text('name is khan');
            var type = $('#sale_type').val();
            console.log("type: " + type);
            $('#discount_div').hide();
        });


        $('#sale_type').change(function() {
            var type = $('#sale_type').val()
            console.log('sale type : ' + type);
            if (type == 2) {

                $('#markup_div').hide();
                $('#plan_div').hide();
                $('#instalment_sec').hide();
                $('#discount_div').show();

            } else {
                $('#markup_div').show();
                $('#plan_div').show();
                $('#instalment_sec').show();
                $('#discount_div').hide();

            }
           

        });

        function getItems() {

            console.log('function callled');
            var letters = $('#item_name').val();
            if (letters.length < 2) {
                return;
            }
            console.log(letters);
            var investor_id = $("#select2-basic").val();
            console.log(investor_id);
            $.ajax({
                url: "{{ route('get-investor-items') }}",
                type: "GET",
                data: {
                    key: letters,
                    investor_id: investor_id
                },
                success: function(dataResult) {
                    $("#listBody").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i].item;
                        console.log(item);
                        markup = `<button id = "btnItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setText(` +
                            item.id + `)">` + item.name + `</button>`;
                        $("#listBody").append(markup);
                    }
                },
                error: function(xhr, status, error) {

                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err);
                },
            });
            $("#list").show();

        }

        function returnSale() {
          
            // event.preventDefault();
            // var id = $("#sale_id").val()
            // console.log(id);


        }

        function getCustomerById() {

            var id = $('#customer_id').val();
            //lo
            if (id.toString().length < 1) {
                $("#customer_name").val("");
                return;
            }

            $.ajax({
                url: "{{ url('customer') }}/" + id,
                type: "GET",
                success: function(dataResult) {

                    console.log('recv');
                    console.log(dataResult);
                    $("#customer_name").val(dataResult.customer_name);

                },
                error: function(xhr, status, error) {
                    $("#customer_name").val("");
                    $("#customer_id").val("");
                },
            });


        }
        $("#search_inv").keypress(function(e) {
            console.log('dfdfdfdfdfdfd');


            if (e.which == 13) {
                event.preventDefault();
                var inv = $('#search_inv').val();

                $.ajax({
                    url: "{{ url('get-sale-no') }}/",
                    type: "GET",
                    data: {
                        key: inv,
                    },
                    success: function(dataResult) {
                        $("#rec_of_name").val("");
                            $("#mar_of_name").val("");
                            $("#customer_name").val("");
                            $("#customer_id").val("");
                            $("#investor_name").val("");
                            $("#sale_date").val("");
                            $("#sale_id").val("");
                        $("#sale_body").empty();
                       
                        if(dataResult.length==0){
                            alert('serch result not found')
                            $('#retBtn').prop('disabled',true);
                            
                        }
                        var i;
                        for (i = 0; i < dataResult.length; i++) {
                            var item = dataResult[i];
                            console.log(item);
                            markup = `<tr> 
                            <td>1</td>
                            <td>` + item.item.id + `</td>
                             <td>` + item.item.name + `</td>
                             <td>` + item.total+`</td>
                             <td> <a href={{ route('sale.create') }}>return</a></td>
                            </tr>`;
                            console.log(item.id);
                            $("#sale_id").val(item.id);
                            $("#sale_body").append(markup);
                            $("#rec_of_name").val(item.recovery_officer.name);
                            $("#mar_of_name").val(item.marketing_officer.name);
                            $("#customer_name").val(item.customer.customer_name);
                            $("#customer_id").val(item.customer.id);
                            $("#investor_name").val(item.investor.investor_name);
                            $("#sale_date").val(item.sale_date);
                            $('#retBtn').prop('disabled',false);


                        }
                    },
                    error: function(xhr, status, error) {
                        $('#retBtn').prop('disabled',true);
                    },
                });
                $("#rec_list").show();

                console.log(inv);
            }
        });


        function getMUserByName() {
            var key = $('#mar_of_name').val();
            console.log(key);
            if (key.toString().length < 3) {

                return;
            }
            $.ajax({
                url: "{{ url('get-marketing-off') }}/",
                type: "GET",
                data: {
                    key: key,
                },
                success: function(dataResult) {
                    $("#mar_list_body").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "marItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setMarUser(` +
                            item.id + `)">` + item.name + `</button>`;
                        $("#mar_list_body").append(markup);
                    }
                },
                error: function(xhr, status, error) {},
            });
            $("#mar_list").show();
        }



        function getRUserByName() {

            var key = $('#rec_of_name').val();
            console.log(key);
            if (key.toString().length < 3) {

                return;
            }
            $.ajax({
                url: "{{ url('get-recovery-off') }}/",
                type: "GET",
                data: {
                    key: key,
                },
                success: function(dataResult) {
                    $("#rec_list_body").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "recItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setRecUser(` +
                            item.id + `)">` + item.name + `</button>`;
                        $("#rec_list_body").append(markup);
                    }
                },
                error: function(xhr, status, error) {},
            });
            $("#rec_list").show();
        }


        function setMarUser(user) {
            console.log('fuck pic');
            $("#mar_of_name").val($('#marItem' + user).text());
            $("#mar_of_id").val(user);
            $("#mar_list").hide();

        }

        function setRecUser(user) {
            $("#rec_of_name").val($('#recItem' + user).text());
            $("#rec_of_id").val(user);
            $("#rec_list").hide();
        }


        function getByName() {

            $("#customer_id").val("");
            var key = $('#customer_name').val();
            //lo
            if (key.toString().length < 3) {

                return;
            }

            $.ajax({
                url: "{{ url('customer-by-name') }}/",
                type: "GET",
                data: {
                    key: key,
                },
                success: function(dataResult) {
                    $("#customer_list_body").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "cusItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setCustomer(` +
                            item.id + `)">` + item.customer_name + `</button>`;
                        $("#customer_list_body").append(markup);
                    }
                    // $("#customer_name").val(dataResult.customer_name);

                },
                error: function(xhr, status, error) {
                    // $("#customer_name").val("");
                    // $("#customer_id").val("");
                },
            });
            $("#customer_list").show();


        }

        $(".content-wrapper").click(function(event) {
            var myClass = $(event.target).hasClass("list-group-item");
            if (myClass == true) {
                console.log("you clicked menu");

            } else {
                $(".list-type").hide();

            }
        });

        function calculateInstallments() {

            console.log('ddfdfdf');
            var sellingPrice = $('#selling_price').val();
            var plan = $('#plan').val();
            var markup = $('#markup').val();
            var finalPrice = (parseFloat(sellingPrice) * (parseFloat(markup) / 100)) + parseFloat(sellingPrice);
            var perMonth = finalPrice / plan;
            var len = parseInt(perMonth).toString().length;
            var factor = Math.pow(10, len - 1);
            var normValue = Math.floor(perMonth / 500) * 500;
            var normTotal = normValue * plan;
            var downPayment = finalPrice - normTotal;

            $('#total_sum_label').text(finalPrice);
            $('#down_payment_label').text(downPayment);
            $('#instalments_label').text(plan);
            $('#per_month_label').text(normValue);

            $('#total_sum').val(finalPrice);
            $('#down_payment').val(downPayment);
            $('#instalments').val(plan);
            $('#per_month').val(normValue);

            // console.log('un normalizedd');
            // console.log(perMonth);
            // console.log('normalizedd');
            // console.log(normValue);
            // console.log('final selling price: ');
            // console.log(finalPrice);
            // console.log('down Payment: ');
            // console.log(downPayment);
        }
        function reAdjust() {
            console.log('re adjusting');
            var  finalPrice =  $('#total_sum').val();
            var  downPayment = $('#down_payment').val();
            var plan = $('#plan').val();

            var rem = finalPrice - downPayment;
            var inst = rem/ plan;
            $('#per_month').val(inst);



        }
        function reAdjust2() {
            console.log('re adjusting2');
            var perMonth = $('#per_month').val();
            var  finalPrice =  $('#total_sum').val();
            var  downPayment = $('#down_payment').val();
            var plan = $('#plan').val();

            var total = perMonth * plan;
            var rem = finalPrice - total;

            $('#down_payment').val(rem);



        }

        function setText(item) {

            console.log($('#item_name' + item).text());
            $("#item_name").val($('#btnItem' + item).text());
            $("#item_id").val(item);
            $("#list").hide();
        }

        function setCustomer(item) {

            // console.log($('#item_name' + item).text());
            $("#customer_name").val($('#cusItem' + item).text());
            $("#customer_id").val(item);
            $("#customer_list").hide();
        }

        $('#select2-basic').change(function() {
            $("#item_id").val("");
            $("#item_name").val("");
        });
    </script>
@endsection
