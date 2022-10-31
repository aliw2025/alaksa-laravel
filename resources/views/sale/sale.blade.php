@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form class="" method="POST" autocomplete="on" action="{{ route('sale.store') }}">
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
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <span class="title">Sale Type</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    <select id="sale_type" name="sale_type" class="form-select"
                                                        aria-label="Default select example">

                                                        <option value="1">Instalments</option>
                                                        <option value="2">Cash</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf
                                                <h4 class="invoice-title">Sale</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-hash">
                                                            <line x1="4" y1="9" x2="20"
                                                                y2="9">
                                                            </line>
                                                            <line x1="4" y1="15" x2="20"
                                                                y2="15">
                                                            </line>
                                                            <line x1="10" y1="3" x2="8"
                                                                y2="21">
                                                            </line>
                                                            <line x1="16" y1="3" x2="14"
                                                                y2="21">
                                                            </line>
                                                        </svg>
                                                    </div>
                                                    <input name="purchaseId" type="text"
                                                        class="form-control invoice-edit-input" placeholder="">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                <input name="sale_date" type="text"
                                                    class="form-control invoice-edit-input date-picker flatpickr-input"
                                                    readonly="readonly">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Investor:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">

                                                    <select name="investor_id"
                                                        class=" select2 select2-hidden-accessible form-control invoice-edit-input"
                                                        id="select2-basic" datas-select2-id="select2-basic" tabindex="-1"
                                                        aria-hidden="true">

                                                        @foreach ($investors as $investor)
                                                            <option value="{{ $investor->id }}">
                                                                {{ $investor->investor_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=" mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer ID:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    <input name="customer_id" onkeyup="getCustomerById()" id="customer_id"
                                                        class="form-control" placeholder="ID" type="text">
                                                </div>
                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer Name:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    <input name="customer_name" onkeyup="getByName()" id="customer_name"
                                                        class="form-control" placeholder="Customer Name" type="text">
                                                    <div class="list-type" id="customer_list"
                                                        style="position: absolute; z-index: 1;" class="card mb-4">
                                                        <div id="customer_list_body" class="list-group">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Header ends -->
                                <hr class="invoice-spacing">
                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
                                    <form class="source-item">
                                        <div data-repeater-list="group-a">
                                            <div class="repeater-wrapper" data-repeater-item="">
                                                <div class="row">

                                                    <div class="col-12  product-details-border position-relative pe-0">
                                                        <div class="row py-2">
                                                            <div class="col-1 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">id</p>
                                                                <input name="item_id" id="item_id" type="number"
                                                                    class="form-control" value="" placeholder="id">
                                                            </div>
                                                            <div class="col-3 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Item Name</p>
                                                                <input onkeyup="getItems()" id="item_name"
                                                                    name="item_name" type="text" class="form-control"
                                                                    placeholder="Item Name">
                                                                <div class="list-type" id="list"
                                                                    style="position: absolute; z-index: 1;"
                                                                    class="card mb-4">
                                                                    <div id="listBody" class="list-group">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Selling Price
                                                                </p>
                                                                <input name="selling_price"
                                                                    onkeyup="calculateInstallments()" id="selling_price"
                                                                    type="number" class="form-control" value=""
                                                                    placeholder="Selling Price">
                                                            </div>
                                                            
                                                            <div id="plan_div" class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Plan (Months)
                                                                </p>
                                                                <input name="plan" onkeyup="calculateInstallments()"
                                                                    id="plan" type="number" class="form-control"
                                                                    value="" placeholder="Months">
                                                            </div>
                                                            
                                                            <div id="markup_div" class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">MarkUp</p>
                                                                <input name="mark_up" onkeyup="calculateInstallments()"
                                                                    id="markup" type="number" class="form-control"
                                                                    value="" placeholder="%">
                                                            </div>
                                                            <div id="discount_div" class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Trade Discount
                                                                </p>
                                                                <input name="trade_discount"
                                                                    id="trade_discount" type="number" class="form-control"
                                                                    value="" placeholder="Discount">
                                                            </div>
                                                        </div><s></s>

                                                    </div>
                                                </div>
                                                <div id="instalment_sec" >
                                                    <div class="row mt-1">
                                                        <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                            <div class="row ">
                                                                <div class="col-6">
                                                                    <p>Total Sum :</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="hidden" id="total_sum"
                                                                        style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                        name="total_sum" class="form-control">
                                                                    <p id="total_sum_label"> 0</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                            <div class="row ">
                                                                <div class="col-6">
                                                                    <p>Down Payment :</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="hidden" id="down_payment"
                                                                        style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                        name="down_payment" class="form-control"
                                                                        value="0 PKR">
                                                                    <p id="down_payment_label"> 0</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                            <div class="row ">
                                                                <div class="col-6">
                                                                    <p>instalments :</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="hidden" id="instalments"
                                                                        style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                        name="instalments" class="form-control"
                                                                        value="0 PKR">
                                                                    <p id="instalments_label"> 0</p>
    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
    
                                                        <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                            <div class="row ">
                                                                <div class="col-6">
                                                                    <p>instalments per Month :</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="hidden" id="per_month"
                                                                        style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                        name="instalment_per_month" class="form-control"
                                                                        value="0 PKR">
                                                                    <p id="per_month_label"> 0</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              
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
                                            {{-- <div class="mb-2">
                                                <label for="note" class="form-label fw-bold">Note:</label>
                                                <textarea name="note" class="form-control" rows="2" id="note"></textarea>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!-- Invoice Note ends -->
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">Save</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
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
            $('.select2-selection__arrow').hide();
            $('#instal').text('name is khan');
            var type = $('#sale_type').val();
            console.log("type: " + type);
            $('#discount_div').hide();
        });

        $('#sale_type').change(function() {
            var type = $('#sale_type').val()
            console.log('sale type : '+type);
            if(type==2){

                $('#markup_div').hide();
                $('#plan_div').hide();
                $('#instalment_sec').hide();
                $('#discount_div').show();
                
            }else{
                $('#markup_div').show();
                $('#plan_div').show();
                $('#instalment_sec').show();
                $('#discount_div').hide();

            }
            // console.log(this.value);

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
            var normValue = Math.floor(perMonth / factor) * factor;
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
