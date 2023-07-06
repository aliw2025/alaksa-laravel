@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
          
            <section class="invoice-add-wrapper">   
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form id="sale_form" method="POST" autocomplete="on"
                            action="{{ $type == 1 ? (isset($sale) ? route('sale.update', $sale->id) : route('sale.store')) : route('sale-return-adjustment') }}">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                @if (isset($sale))
                                    {{ method_field('PUT') }}
                                @endif
                                @if (isset($sale))
                                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                @endif
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
                                                
                                                    <input value="{{ $sale->marketingOfficer->name }}" id="mar_of_name"
                                                        name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               

                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Recovery Officer: </span>
                                                
                                                    <input value="{{ $sale->recoveryOfficer->name }}" id="rec_of_name"
                                                        name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               

                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Inquiry Officer: </span>
                                                
                                                
                                                    <input id="rec_of_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                                

                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="title">Sale Type:</span>
                                               
                                                
                                                    <input value="{{ $sale->payment_type == 1 ? 'instaments' : 'Cash' }}"
                                                        id="sale_type" name="sale_type" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <h4 style="text-decoration: underline">
                                            Sale Return</h4>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf                                              
                                                <h4 class="invoice-title"> Sale#
                                                </h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">

                                                    <input id="search_inv"
                                                        @if (isset($sale)) value="{{ $sale->invoice_no }}" @endif
                                                        @if ($type == 1) disabled @endif
                                                        name="purchaseId" type="text"
                                                        class="form-control invoice-edit-input" placeholder="">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Status:</span>
                                               
                                                    <input value="{{ $sale->transaction_status->desc }}" id="sale_status"
                                                        name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                
                                                    <input value="{{ $sale->sale_date }}" id="sale_date"
                                                        name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               
                                            </div>

                                           
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Investor:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                   
                                                        <input type="hidden" name="investor_id"
                                                            value="{{ $sale->investor_id }}">
                                                        <input value="{{ $sale->investor->investor_name }}"
                                                            id="investor_name" name="purchase_date" type="text"
                                                            class="form-control invoice-edit-input" readonly="readonly">
                                                   
                                                </div>
                                            </div>
                                            <div class=" mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer ID:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                
                                                        <input value="{{ $sale->customer_id }}" id="customer_id"
                                                            name="purchase_date" type="text"
                                                            class="form-control invoice-edit-input" readonly="readonly">
                                                  

                                                </div>
                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer Name:</span>
                                                
                                                    <input value="{{ $sale->customer->customer_name }}"
                                                        id="customer_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Header ends -->
                                <hr class="invoice-spacing">
                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
                                    <form class="source-item">
                                    
                                            
                                        
                                            <table id="investor-table" class="table">
                                                <thead class="thead-dark">
                                                    <tr style="background-color:red !important;">
                                                        <th style="width: 2px !important">#</th>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Item Name</th>
                                                        <th scope="col">Selling Price</th>
                                                        <th scope="col">Plan</th>
                                                        <th scope="col">MarK Up</th>
                                                        <th scope="col">total</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="sale_body" id="sale_body">
                                                    <td>1</td>
                                                    <td>{{ $sale->item->id }}</td>
                                                    <td>{{ $sale->item->name }}</td>
                                                    <td>{{ number_format($sale->selling_price) }}</td>
                                                    <td>{{ $sale->plan }}</td>
                                                    <td>{{ $sale->markup }}</td>
                                                    <td>{{ number_format($sale->total) }}</td>
                                                </tbody>
                                            </table>
                                            <div cslass="row">

                                                <div class="col-3">
                                                    <div class=" mt-1">
                                                        <label class="title me-1">Return to Customer:</label>
                                                        <input id="customer_id" name="return_customer" type="text"
                                                            class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class=" mt-1">
                                                        <label class="title me-1">Returns to Investor:</label>
                                                        <input id="customer_id" name="return_investor" type="text"
                                                            class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="mt-1">
                                                        <label class="title me-1">Alp Cut:</label>
                                                        <input id="customer_id" name="return_alp" type="text"
                                                            class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                            </div>
                                            <div class="row">

                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-12 mt-1">
                                                    Total Amount Recieved: {{ number_format($total_amount_paid) }}
                                                    <input type="hidden" name="total_amount_paid"
                                                        value="{{ $total_amount_paid }}">
                                                </div>
                                                <div class="col-12 mt-1">
                                                    Total Inventory Recovery: {{ number_format($inventory_money) }}
                                                    <input type="hidden" name="inventory_money"
                                                        value="{{ $inventory_money }}">
                                                </div>
                                                <div class="col-12 mt-1">
                                                    Investor Mark up Recieved: {{ number_format($share) }}
                                                    <input type="hidden" name="investor_share"
                                                        value="{{ $share }}">
                                                </div>
                                                <div class="col-12 mt-1">
                                                    Company Mark up Recieved: {{ number_format($share) }}
                                                    <input type="hidden" name="company" value="{{ $share }}">
                                                </div>
                                            </div>
                                

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
                                
                                    <div class="row p-2">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end">

                                                <button id="retBtn" class="btn btn-primary me-2">Return</button>
                                            </div>
                                        </div>
                                    </div>
                               

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
        
            @if(isset($message))
            console.log('here');
            toastr.success(
                "{{$message}}",
                "Success!", {
                    closeButton: !0,
                    tapToDismiss: !1,
                    rtl: false
                }
            );
            @endif
            $('.select2-selection__arrow').hide();
            $('#instal').text('name is khan');
            var type = $('#sale_type').val();
            console.log("type: " + type);
            if (type == 1) {
                $('#discount_div').hide();
            } else {
                $('#markup_div').hide();
                $('#plan_div').hide();
            }

            // getinvAccount()
            var inv = $('#search_inv').val();

        });

        $('#sale_type').change(function() {
            // hide and show feilds based on sale type
            var type = $('#sale_type').val()
            // console.log('sale type : ' + type);
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

        // get items 
        function getItems() {

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

        function getInUserByName() {
            var key = $('#inq_of_name').val();
            console.log(key);
            if (key.toString().length < 3) {

                return;
            }
            // change the routes later after done with roles
            $.ajax({
                url: "{{ url('get-inquiry-off') }}/",
                type: "GET",
                data: {
                    key: key,
                },
                success: function(dataResult) {
                    $("#inq_list_body").empty();
                    console.log('inqv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "inItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setInUser(` +
                            item.id + `)">` + item.name + `</button>`;
                        $("#inq_list_body").append(markup);
                    }
                },
                error: function(xhr, status, error) {},
            });
            $("#inq_list").show();
        }


        function setInUser(user) {

            $("#inq_of_name").val($('#inItem' + user).text());
            $("#inq_of_id").val(user);
            $("#inq_list").hide();

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
            var sellingPrice = Number(sellingPrice.replace(/[^0-9.-]+/g, ""));
            var plan = $('#plan').val();
            var markup = $('#markup').val();
            var finalPrice = (parseFloat(sellingPrice) * (parseFloat(markup) / 100)) + parseFloat(sellingPrice);
            var perMonth = finalPrice / plan;
            var len = parseInt(perMonth).toString().length;
            var factor = Math.pow(10, len - 1);
            var normValue = Math.floor(perMonth / 500) * 500;
            var normTotal = normValue * plan;
            var downPayment = finalPrice - normTotal;

            $('#total_sum_label').text(finalPrice.toLocaleString('en-US'));
            $('#down_payment_label').text(downPayment);
            $('#instalments_label').text(plan);
            $('#per_month_label').text(normValue);

            $('#total_sum').val(finalPrice.toLocaleString('en-US'));
            $('#down_payment').val(downPayment.toLocaleString('en-US'));
            $('#instalments').val(plan);
            $('#per_month').val(normValue.toLocaleString('en-US'));

        }

        function reAdjust() {
            console.log('re adjusting');
            var finalPrice = $('#total_sum').val();
            finalPrice = Number(finalPrice.replace(/[^0-9.-]+/g, ""));
            var downPayment = $('#down_payment').val();
            downPayment = Number(downPayment.replace(/[^0-9.-]+/g, ""));
            var plan = $('#plan').val();

            var rem = finalPrice - downPayment;
            var inst = rem / plan;
            $('#per_month').val(inst.toLocaleString('en-US'));
        }

        function reAdjust2() {
            console.log('re adjusting2');
            var perMonth = $('#per_month').val();
            perMonth = Number(perMonth.replace(/[^0-9.-]+/g, ""));
            var finalPrice = $('#total_sum').val();
            finalPrice = Number(finalPrice.replace(/[^0-9.-]+/g, ""));
            var downPayment = $('#down_payment').val();
            downPayment = Number(downPayment.replace(/[^0-9.-]+/g, ""));
            var plan = $('#plan').val();

            var total = perMonth * plan;
            var rem = finalPrice - total;

            $('#down_payment').val(rem.toLocaleString('en-US'));

        }


        function setText(item) {

            console.log($('#item_name' + item).text());
            $("#item_name").val($('#btnItem' + item).text());
            $("#item_id").val(item);
            $("#list").hide();


            $.ajax({
                url: "{{ url('get-item') }}/" + item,
                type: "GET",

                success: function(itemDetail) {

                    console.log('got item2');
                    console.log(itemDetail);
                    $('#i_name').val(itemDetail.name);
                    $('#i_make').val(itemDetail.make);
                    $('#i_model').val(itemDetail.model);

                    var sec = $('#custom-section');
                    sec.empty();
                    // style="border: none;background-color: transparent;resize: none;outline: none;"
                    for (i = 0; i < itemDetail.property_values.length; i++) {
                        var prop = itemDetail.property_values[i];
                        var markup = ` <div class="col-6">` +
                            `<label class="form-label" for="">` + prop.prop_name + `</label>` +
                            `<input value="` + prop.prop_value +
                            `" id="i_model"  type="text" class="form-control"></div>`;

                        sec.append(markup);
                    }


                },
                error: function(xhr, status, error) {

                },
            });
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

            // get new accounts for investor 
            // getinvAccount()


        });

        function getinvAccount() {

            var investor_id = $("#select2-basic").val();
            $.ajax({
                url: "{{ url('investor-cash-accounts') }}/" + investor_id,
                type: "GET",

                success: function(dataResult) {
                    var i;
                    var acc_sel = $('#acc_type');
                    acc_sel.empty();

                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        acc_sel.append($('<option>', {
                            text: item.account_name,
                            value: item.id
                        }));

                    }
                },
                error: function(xhr, status, error) {},
            });
        }
    </script>
@endsection
