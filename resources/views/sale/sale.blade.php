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
                    <form id="sale_form" method="POST" autocomplete="on" action="{{ (isset($sale) ? route('sale.update', $sale->id) : route('sale.store'))  }}">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            @if (isset($sale))
                            {{ method_field('PUT') }}
                            @endif
                            @if (isset($sale))
                            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            @endif
                            <div class="card-body invoice-padding pb-0">
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <h3 class="ms-0 text-primary invoice-logo">Alpha Digital</h3>
                                        </div>
                                        <p class="card-text mb-25">Office 149,Mustafa plaza</p>
                                        <p class="card-text mb-25">Ring Road Peshawar, PK</p>
                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>

                                        <div class="mt-2 d-flex align-items-center justify-content-between">
                                            <span class="title me-1">Marketing Officer: </span>

                                            <div style="width: 11.21rem; max-width:11.21rem;" class="align-items-center">
                                                <input @if (isset($sale)) value="{{ $sale->marketingOfficer->id }}" @endif name="mar_of_id" id="mar_of_id" s class="form-control" placeholder="Name" type="hidden">
                                                <input @if (isset($sale)) value="{{ $sale->marketingOfficer->name }}" @endif name="mar_of_name" onkeyup="getMUserByName()" id="mar_of_name" class="form-control" placeholder="Name" type="text" @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                <div class="list-type" id="mar_list" style="position: absolute; z-index: 1;" class="card mb-4">
                                                    <div id="mar_list_body" class="list-group">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mt-1 d-flex align-items-center justify-content-between">
                                            <span class="title">Recovery Officer: </span>

                                            <div style="width: 11.21rem; max-width:11.21rem;" class="align-items-center">
                                                <input @if (isset($sale)) value="{{ $sale->recoveryOfficer->id }}" @endif name="rec_of_id" id="rec_of_id" class="form-control" placeholder="Name" type="hidden">
                                                <input @if (isset($sale)) value="{{ $sale->recoveryOfficer->name }}" @endif name="rec_of_name" onkeyup="getRUserByName()" id="rec_of_name" class="form-control" placeholder="Name" type="text" @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                <div class="list-type" id="rec_list" style="position: absolute; z-index: 1;" class="card mb-4">
                                                    <div id="rec_list_body" class="list-group">

                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="mt-1 d-flex align-items-center justify-content-between">
                                            <span class="title">Inquiry Officer: </span>

                                            <div style="width: 11.21rem; max-width:11.21rem;" class="align-items-center">
                                                <input @if (isset($sale)) value="{{ $sale->inquiryOfficer->id }}" @endif name="inq_of_id" id="inq_of_id" s class="form-control" placeholder="Name" type="hidden">
                                                <input @if (isset($sale)) value="{{ $sale->inquiryOfficer->name }}" @endif name="inq_of_name" onkeyup="getInUserByName()" id="inq_of_name" class="form-control" placeholder="Name" type="text" @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                <div class="list-type" id="inq_list" style="position: absolute; z-index: 1;" class="card mb-4">
                                                    <div id="inq_list_body" class="list-group">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Sale Type:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <select id="sale_type" name="sale_type" class="form-select" aria-label="Default select example" @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                    <option @if(isset($sale)) @if($sale->payment_type == 1) selected @endif @endif value="1">Instalments</option>
                                                    <option @if(isset($sale)) @if($sale->payment_type == 2) selected @endif @endif value="2">Cash</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <h4 style="text-decoration: underline">
                                            Sale
                                        </h4>
                                        @if(isset($sale))
                                        @if(($sale->status==2))
                                        <h4 style="color:red">Cancelled</h4>
                                        @elseif(($sale->status==3))
                                        <h4 style="color:green">Posted</h4>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            @csrf

                                            <h4 class="invoice-title"> Sale #</h4>
                                            <div class="input-group input-group-merge invoice-edit-input-group">

                                                <input id="search_inv" @if (isset($sale)) value="{{ $sale->invoice_no }}" @endif @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif
                                                name="purchaseId" type="text"
                                                class="form-control invoice-edit-input" placeholder="">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Status:</span>

                                            <input @if(isset($sale)) value="{{ $sale->transaction_status->desc }}" @endif id="sale_status" name="sale_status" type="text" class="form-control invoice-edit-input" readonly="readonly">
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Date:</span>
                                            <input  value="{{ isset($sale)? $sale->sale_date: date('Y-m-d')}}"  id="sale_date" name="sale_date" type="date" class="form-control invoice-edit-input" @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                        </div>

                                        @if (!isset($sale))
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Recieving Account</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select id="acc_type" name="acc_type" class="form-select">
                                                    <option value="1">
                                                        cash
                                                    </option>
                                                    @foreach ($bank_acc as $acc)
                                                    <option value="{{ $acc->id }}">
                                                        {{ $acc->account_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="title">Investor:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select name="investor_id" class=" select2 select2-hidden-accessible form-control invoice-edit-input" id="select2-basic" datas-select2-id="select2-basic" tabindex="-1" aria-hidden="true" @if (isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                    @foreach ($investors as $investor)
                                                    <option @if (isset($sale)) @if(($sale->investor_id==$investor->id)) selected @endif @endif value="{{ $investor->id }}">
                                                        {{ $investor->investor_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" mt-1 d-flex align-items-center justify-content-between">
                                            <span class="title">Customer ID:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <input @if (isset($sale)) value="{{ $sale->customer->id }}" @endif name="customer_id" onkeyup="getCustomerById()" id="customer_id" class="form-control" placeholder="ID" type="text" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                            </div>
                                        </div>
                                        <div class="mt-1 d-flex align-items-center justify-content-between">
                                            <span class="title">Customer Name:</span>

                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <input @if (isset($sale)) value="{{ $sale->customer->customer_name }}" @endif name="customer_name" onkeyup="getByName()" id="customer_name" class="form-control" placeholder="Customer Name" type="text" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                <div class="list-type" id="customer_list" style="position: absolute; z-index: 1;" class="card mb-4">
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
                                                            <input @if (isset($sale)) value="{{ $sale->item_id }}" @endif name="item_id" id="item_id" type="number" class="form-control" value="" placeholder="id" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                        </div>
                                                        <div class="col-3 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Item Name
                                                            </p>
                                                            <input @if (isset($sale)) value="{{ $sale->item->name }}" @endif onkeyup="getItems()" id="item_name" name="item_name" type="text" class="form-control" placeholder="Item Name" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            <div class="list-type" id="list" style="position: absolute; z-index: 1;" class="card mb-4">
                                                                <div id="listBody" class="list-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (!isset($sale) || (isset($sale) && $sale->payment_type == 1))
                                                        <div class="col-2 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Selling
                                                                Price
                                                            </p>
                                                            <input @if (isset($sale)) value="{{ number_format($sale->selling_price) }}" @endif name="selling_price" onkeyup="calculateInstallments()" id="selling_price" class=" @error('selling_price') is-invalid @enderror number-separator form-control" value="" placeholder="Selling Price" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            @error('selling_price')
                                                            <div class="alert alert-danger">
                                                                {{$message}}
                                                            </div>

                                                            @enderror
                                                        </div>

                                                        <div id="plan_div" class="col-2 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Plan
                                                                (Months)
                                                            </p>
                                                            <input @if (isset($sale)) value="{{ number_format($sale->plan) }}" @endif name="plan" onkeyup="calculateInstallments()" id="plan" type="number" class="@error('plan') is-invalid @enderror form-control" value="" placeholder="Months" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            @error('plan')
                                                            <div class="alert alert-danger">
                                                                {{$message}}
                                                            </div>

                                                            @enderror
                                                        </div>

                                                        <div id="markup_div" class="col-2 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">MarkUp
                                                            </p>
                                                            <input @if (isset($sale)) value="{{ number_format($sale->markup) }}" @endif name="markup" onkeyup="calculateInstallments()" id="markup" type="number" class="@error('markup') is-invalid @enderror form-control" value="" placeholder="%" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            @error('markup')
                                                            <div class="alert alert-danger">
                                                                {{$message}}
                                                            </div>

                                                            @enderror
                                                        </div>
                                                        @endif
                                                        <div id="discount_div" class="col-2 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Trade
                                                                Discount
                                                            </p>
                                                            <input name="trade_discount" id="trade_discount" type="number" class="form-control" @if (isset($sale)) value="{{ number_format($sale->trade_discount) }}" @endif placeholder="Discount" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                        </div>

                                                    </div><s></s>

                                                </div>
                                            </div>
                                            <div>
                                                <div class="row mt-1">
                                                    @if (!isset($sale) || (isset($sale) && $sale->payment_type == 1))
                                                    <div id="instalment_sec" class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                        <h4>Instalment details</h4>
                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-6  mt-1">
                                                                <p>Total Sum :</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <input @if (isset($sale)) value="{{ number_format($sale->total) }}" @endif id="total_sum" style=" border: none;background-color: transparent;resize: none;outline: none;" name="total_sum" class="form-control" value="0" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-6  mt-1">
                                                                <p>Down Payment :</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <input @if (isset($sale)) value="{{ number_format($sale->downpayment) }}" @endif onkeyup="reAdjust()" id="down_payment" style="border: none;background-color: transparent;resize: none;outline: none;" name="down_payment" class="number-separator form-control" value="0" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex align-items-center ">
                                                            <div class="col-6 mt-1">
                                                                <p>instalments :</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <input @if (isset($sale)) value="{{ number_format($sale->plan) }}" @endif disabled id="instalments" style=" border: none;background-color: transparent;resize: none;outline: none;" name="instalments" class=" form-control" value="0" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-6 mt-1">
                                                                <p>instalments per Month :</p>
                                                            </div>
                                                            <div class="col-6 ">
                                                                <input @if (isset($sale)) value="{{ number_format(($sale->total - $sale->downpayment) / $sale->plan) }}" @endif onkeyup="reAdjust2()" id="per_month" style=" border: none;background-color: transparent;resize: none;outline: none;" name="instalment_per_month" class=" number-separator form-control" value="0" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>

                                                            </div>
                                                        </div>

                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-6  mt-1">
                                                                <p>Down Payment Paid :</p>
                                                            </div>
                                                            <div class=" col-6">
                                                                <input name="down_payment_paid" class="ms-1 form-check-input" type="checkbox" value="1" id="flexCheckDefault" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="col-7">
                                                        <h4>Item details</h4>
                                                        <div id="item-detail-sec" class="row">

                                                            <div class="col-6">
                                                                <label class="form-slabel" for="">Serial /
                                                                    IME#</label>
                                                                <input @if (isset($sale)) value="{{ $sale->seriel_no }}" @endif name='seriel_no' type="text" class="form-control" @if(isset($sale)) @if(($sale->status!=1)) disabled @endif @endif>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label" for="">Item
                                                                    Name</label>
                                                                <input @if (isset($sale)) value="{{ $sale->item->name }}" @endif id="i_name" type="text" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label" for="">Make</label>
                                                                <input @if (isset($sale)) value="{{ $sale->item->make }}" @endif id="i_make" type="text" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-slabel" for="">Model</label>
                                                                <input @if (isset($sale)) value="{{ $sale->item->model }}" @endif id="i_model" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div id="custom-section" class="row">
                                                            @if (isset($sale))
                                                            @foreach ($sale->item->propertyValues as $prop)
                                                            <div class="col-6">
                                                                <label class="form-slabel" for="">{{ $prop->propertyName->property_name }}</label>
                                                                <input value="{{ $prop->prop_value }}" id="i_model" type="text" class="form-control" disabled>
                                                            </div>
                                                            @endforeach
                                                            @endif
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
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>

                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end">
                                        @if (isset($sale))
                                                @if ($sale->status == 1)
                                                <button type="submit" name="action" value="post" class="btn btn-success me-2">Post</button>
                                                <button type="submit" name="action" value="cancel" class="btn btn-danger me-2">Cancel</button>
                                                <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
                                                
                                                @elseif($sale->status == 3)
                                                <button type="submit" name="action" value="reprint" class="btn btn-primary me-2">Reprint</button>
                                                <button type="submit" name="action" value="return" class="btn btn-danger me-2">Return</button>
                                                @endif
                                        @else
                                        <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        @endif
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
{{-- <script src="http://localhost/cssd/resources/vendors/js/extensions/toastr.min.js"></script> --}}
@if(Session::has('message'))
<script>
    $(document).ready(function() {
        toastr.success("{{Session::get('message')}}", "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: false
        });
    });
</script>
@endif
<script>
    $(document).ready(function() {

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