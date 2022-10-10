@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form class="" method="POST" autocomplete="on" action="{{ route('purchase.store')}}">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                <h3 class="ms-0 text-primary invoice-logo">Alpha Digital</h3>
                                            </div>
                                            <p class="card-text mb-25">Office 149,Mustafa plaza</p>
                                            <p class="card-text mb-25">Ring Road Peshawar, PK</p>
                                            <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>

                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf
                                                <h4 class="invoice-title">Purchase</h4>
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
                                                    <input name ="purchaseId" type="text" class="form-control invoice-edit-input"
                                                        placeholder="">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                <input name="purchase_date" type="text"
                                                    class="form-control invoice-edit-input date-picker flatpickr-input"
                                                    readonly="readonly">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Account:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    <select name = "investor_id"
                                                        class=" select2 select2-hidden-accessible form-control invoice-edit-input"
                                                        id="select2-basic" data-select2-id="select2-basic" tabindex="-1"
                                                        aria-hidden="true">
                                                        @foreach ($investors as $investor)
                                                            <option value="{{ $investor->id }}">{{ $investor->investor_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="title">Supplier</span>
                                                {{-- <select class="form-control" name="supplier" id=""></select> --}}
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                class="align-items-center">
                                                <select name="supplier" class="form-select" aria-label="Default select example">

                                                   @foreach ($suppliers as $sup)
                                                   <option value="{{$sup->id}}">{{$sup->name}}</option>
                                                   @endforeach
                                                   
                                                   
                                                  </select>
                                                </div>
                                                {{-- <input name = "supplier" type="text" class="form-control invoice-edit-input "> --}}
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
                                                    <div
                                                        class="col-12 d-flex product-details-border position-relative pe-0">
                                                        <div class="row py-2">
                                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Item Id</p>
                                                                <input  id="passId0" type="number" class="form-control"
                                                                    value="" placeholder="" disabled>
                                                                    <input name="item_id[]" id="item_id0" type="hidden" class="form-control"
                                                                    value="" placeholder="" >
                                                            </div>
                                                            <div class="col-3">
                                                                <p class="card-text col-title mb-md-2 mb-0">Item Name</p>
                                                                <input autocomplete="off" id="itemBox0"
                                                                    class=" form-control" autocomplete="off"
                                                                    placeholder="Enter Item" onkeyup="getItems(0)">
                                                                <div class="list-type" id="list0"
                                                                    style="position: absolute; z-index: 1;"
                                                                    class="card mb-4">
                                                                    <div id="listBody0" class="list-group">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">cost</p>
                                                                <input onkeyup="calRowTotal(0)" id="cost0"
                                                                    name="cost[]" type="number" class="form-control"
                                                                    value="" placeholder="">
                                                            </div>
                                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                                                <input pattern="[0-9]{10}" onkeyup="calRowTotal(0)"
                                                                    id="qty0" name="qty[]" type="number"
                                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                                    class="form-control" value="" placeholder="">
                                                            </div>
                                                            <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                                <p class="card-text col-title mb-md-50 mb-0">Total</p>
                                                                <input 
                                                                    style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                    id="rowTotal0" name="rowTotal[]" class="form-control"
                                                                    value="0 PKR" disabled>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-flex flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25">
                                                            <svg onclick="deleteItem(0)"
                                                                xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-x cursor-pointer font-medium-3">
                                                                <line x1="18" y1="6" x2="6"
                                                                    y2="18"></line>
                                                                <line x1="6" y1="6" x2="18"
                                                                    y2="18"></line>
                                                            </svg>
                                                            <div class="dropdown">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-settings cursor-pointer more-options-dropdown me-0"
                                                                    id="dropdownMenuButton" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <circle cx="12" cy="12" r="3">
                                                                    </circle>
                                                                    <path
                                                                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                                    </path>
                                                                </svg>
                                                                <div class="dropdown-menu dropdown-menu-end item-options-menu p-50"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <div class="mb-1">
                                                                        <label  for="discount-input"
                                                                            class="form-label">Discount</label>
                                                                        <input name = "trade_dicount" type="number" class="form-control"
                                                                            id="discount-input">
                                                                    </div>
                                                                    <div class="form-row mt-50"></div>
                                                                    <div class="dropdown-divider my-1"></div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary btn-apply-changes waves-effect">Apply</button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary waves-effect">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="itemRows" class="row mt-1">
                                            <div class="col-12 px-0">
                                                <button id="addNewBtn" type="button"
                                                    class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-plus me-25">
                                                        <line x1="12" y1="5" x2="12"
                                                            y2="19">
                                                        </line>
                                                        <line x1="5" y1="12" x2="19"
                                                            y2="12">
                                                        </line>
                                                    </svg>
                                                    <span class="align-middle">Add Item</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Product Details ends -->

                                <!-- Invoice Total starts -->
                                <div class="card-body invoice-padding">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">

                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50">
                                                <div class="invoice-total-item">
                                                    <input type="hidden" name="total_amount" id="amount_feild" >
                                                    <p class="invoice-total-title">Total:</p>
                                                    <p id="totalAmount" class="invoice-total-amount">0 PKR</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Total ends -->
                                <hr class="invoice-spacing mt-0">

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="note" class="form-label fw-bold">Note:</label>
                                                <textarea name="note" class="form-control" rows="2" id="note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Invoice Note ends -->
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">Save</button>
                                            <button type = "reset" class="btn btn-danger">Reset</button>
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
        var rowId = 0;
        $(document).ready(function() {

            $('.select2-selection__arrow').hide();
        });

        $('#addNewBtn').click(function() {
            console.log('ad-new item');
            rowId = rowId + 1;
            var maarkup = `<div id="row${rowId}" class="row">
                        <div class="mt-3 col-12 d-flex product-details-border position-relative pe-0">
                            <div class="row py-2">
                                    <div class="col-lg-2 col-12 my-lg-0 my-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Item Id</p>
                                    <input name="item_id[]" id ="passId${rowId}" type="number" class="form-control" value="" placeholder="" disabled>
                                    <input name="item_id[]" id="item_id${rowId}" type="hidden" class="form-control"
                                                                    value="" placeholder="" >
                                    </div>
                                <div class="col-3">
                                    <p class="card-text col-title mb-md-2 mb-0">Item Name</p>
                                    
                                    <input autocomplete="off" id="itemBox${rowId}" class=" form-control" autocomplete="off"
                                        placeholder="Enter Item"
                                        onkeyup="getItems(${rowId})">
                                    <div class="list-type" id="list${rowId}" style="position: absolute; z-index: 1;"
                                        class="card mb-4">
                                        <div id="listBody${rowId}" class="list-group">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12 my-lg-0 my-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Cost</p>
                                    <input onkeyup="calRowTotal(${rowId})" id="cost${rowId}" name="cost[]" type="number" class="form-control" value=""
                                        placeholder="">
                                </div>
                                <div class="col-lg-2 col-12 my-lg-0 my-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                    <input   onkeyup="calRowTotal(${rowId})" id="qty${rowId}" name="qty[]"
                                        type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"class="form-control" value=""
                                        placeholder="">
                                </div>
                                <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                    <p class="card-text col-title mb-md-50 mb-0">Total</p>
                                    <input style=" border: none;background-color: transparent;resize: none;outline: none;" id="rowTotal${rowId}"  name="rowTotal[]"  class="form-control" value="0 PKR" disabled>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25">
                                <svg onclick="deleteItem(${rowId})" xmlns="http://www.w3.org/2000/svg" width="14"
                                    height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-x cursor-pointer font-medium-3"
                                    >
                                    <line x1="18" y1="6" x2="6"
                                        y2="18"></line>
                                    <line x1="6" y1="6" x2="18"
                                        y2="18"></line>
                                </svg>
                                <div class="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                        height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-settings cursor-pointer more-options-dropdown me-0"
                                        id="dropdownMenuButton" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <circle cx="12" cy="12" r="3">
                                        </circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>
                                    <div class="dropdown-menu dropdown-menu-end item-options-menu p-50"
                                        aria-labelledby="dropdownMenuButton">
                                        <div class="mb-1">
                                            <label for="discount-input"
                                                class="form-label">Discount</label>
                                            <input name="trade_discount" type="number" class="form-control"
                                                id="discount-input">
                                        </div>
                                        <div class="form-row mt-50"></div>
                                        <div class="dropdown-divider my-1"></div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button"
                                                class="btn btn-outline-primary btn-apply-changes waves-effect">Apply</button>
                                            <button type="button"
                                                class="btn btn-outline-secondary waves-effect">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

            $('.repeater-wrapper').append(maarkup);
        })
        // var lastVall= 0;
        function calRowTotal(rowId) {

            var qty = $('#qty' + rowId).val();
            var cost = $('#cost' + rowId).val();
            var old = $("#rowTotal" + rowId).val();
            var total = qty * cost;
            $("#rowTotal" + rowId).val(total.toFixed(2).toString() + " PKR");
            var subTotal = $("#totalAmount").text();
            var sum = parseFloat(subTotal) + parseFloat(total) - parseFloat(old);
            $("#totalAmount").text(sum.toFixed(2).toString() + " PKR");
            $("#amount_feild").val(sum.toFixed(2));



        }

        function getItems(id) {

            console.log("arg");
            // console.log(set.id);
            var letters = $('#itemBox' + id).val();
            if (letters.length < 2) {
                return;
            }
            $("#passId").val("");
            $.ajax({
                url: "{{ route('get-items') }}",
                type: "GET",
                data: {
                    key: letters,
                },
                success: function(dataResult) {
                    $("#listBody" + id).empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {

                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "btnItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setText(` +
                            item.id + `,${id})">` + item.name + `</button>`;
                        $("#listBody" + id).append(markup);
                    }
                },
                error: function(xhr, status, error) {

                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err);
                },
            });
            $("#list" + id).show();
            console.log(letters);
        }

        function deleteItem(id) {
            $('#row' + id).remove();
        }

        $(".content-wrapper").click(function(event) {
            console.log('clicked');
            var myClass = $(event.target).hasClass("list-group-item");
            if (myClass == true) {
                console.log("you clicked menu");

            } else {
                $(".list-type   ").hide();

            }
        });

        function setText(item, rowId) {
            // var item = JSON.parse(item);
            console.log($('#btnItem' + item).text());
            $("#itemBox" + rowId).val($('#btnItem' + item).text());
            $("#passId" + rowId).val(item);
            $("#item_id" + rowId).val(item);
            $("#list" + rowId).hide();

        }
    </script>
@endsection


