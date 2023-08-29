@extends('template.header')
@section('section')
<div class="content-wrapper container-xxl p-0">
    <div class="content-body">
        <section class="invoice-add-wrapper">
            <div class="row invoice-add">
                <!-- Invoice Add Left starts -->
                <div class="col-xl-12 col-md-12 col-12">
                    <form class="" method="POST" autocomplete="on" action="{{ isset($purchase)? route('purchase.update',$purchase->id): route('purchase.store') }}">
                        <div class="card invoice-preview-card">

                            @if(isset($purchase))
                            {{ method_field('PUT') }}
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

                                    </div>
                                    <div class="mt-2">
                                        <h4 style="text-decoration: underline">{{ $type == 1 ? 'Purchase' : 'Purchase Return' }}</h4>
                                        @if(isset($purchase))
                                        @if(($purchase->status==2))
                                        <h4 style="color:red">Cancelled</h4>
                                        @elseif(($purchase->status==3))
                                        <h4 style="color:green">Posted</h4>
                                        @endif
                                        @endif

                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            @csrf
                                            <input id="tran_type" type="hidden" value="{{$type}}" name="tran_type">
                                            <input type="hidden" name="purchase_type" id="purchase_type" value="{{ $type }}">
                                            <h4 class="invoice-title"> {{ $type == 1 ? 'Purchase #' : 'Purchase Return #' }}</h4>
                                            <div class="input-group input-group-merge invoice-edit-input-group">
                                                <input style="font-size: 12px" @if (isset($purchase)) disabled value="{{ $purchase->purchase_no }}" @endif name="purchaseId" type="text" class="form-control invoice-edit-input" placeholder="" disabled>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Date:</span>
                                            <input type="date" name="purchase_date" class="invoice-edit-input form-control" value="{{ isset($purchase)? $purchase->purchase_date: now()->format('Y-m-d')}}" @if(isset($purchase )) @if(!($purchase->status==1)) disabled @endif @endif>
                                            @error('purchase_date')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="title">Investor:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select @if(isset($purchase )) @if(!($purchase->status==1)) disabled @endif @endif name="investor_id" class=" select2 select2-hidden-accessible form-control invoice-edit-input" id="select2-basic" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                    @foreach ($investors as $investor)
                                                    <option @if(isset($purchase)) @if($purchase->investor_id==$investor->id) selected @endif @endif value="{{ $investor->id }}">
                                                        {{ $investor->investor_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Supplier</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select t @if(isset($purchase )) @if(!($purchase->status==1)) disabled @endif @endif id="supplier_id" name="supplier" class=" @error('supplier') is-invalid @enderror form-select" aria-label="Default select example">
                                                    @foreach ($suppliers as $sup)
                                                    <option @if(isset($purchase)) @if($purchase->supplier==$sup->id) selected @endif @endif value="{{ $sup->id }}">{{ $sup->name }} </option>
                                                    @endforeach
                                                </select>

                                                @error('supplier')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Header ends -->
                            <hr class="invoice-spacing">
                            <!-- @If(isset($message))
                                    <div class="alert alert-success">
                                        {{$message}}
                                    </div>
                                @endif -->
                            @error('item_id')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            @error('item_id.*')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            @error('qty.*')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            @error('cost.*')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            <!-- Product Details starts -->
                            <div class="card-body invoice-padding invoice-product-details">
                                <form class="source-item">
                                    <div id="test-section" data-repeater-list="group-a">
                                        <div class="repeater-wrapper" data-repeater-item="">
                                            @if(isset($purchase) )
                                            <input type="hidden" value="{{$purchase->id}}" name="purchase_id">
                                            @php
                                            $row_count=0
                                            @endphp
                                            @foreach($purchase->purchaseItems as $pitem)
                                            <div id="{{$row_count}}" class="mt-3 row">
                                                <div class="col-12 d-flex product-details-border position-relative pe-0">
                                                    <div class="row py-2">
                                                        <div class="col-lg-1 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Item Id</p>
                                                            <input value="{{$pitem->item_id}}" id="passId{{$row_count}}" type="number" class="form-control" value="" placeholder="" onkeyup="getItemsById({{$row_count}},this.value)">
                                                            <input value="{{$pitem->item_id}}" name="item_id[]" id="item_id{{$row_count}}" type="hidden" class="form-control" value="" placeholder="">
                                                            <!-- <input type="hidden" value="{{$pitem->id}}" name="item_id[]"> -->
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Item Name</p>
                                                            <input value="{{$pitem->item->name}}" autocomplete="off" id="itemBox{{$row_count}}" class=" form-control" autocomplete="off" placeholder="Enter Item" @if($type==1) onkeyup="getItems({{$row_count}})" @else onkeyup="getInvItems(0)" @endif @if(!($purchase->status==1)) disabled @endif>
                                                            <div class="list-type" id="list{{$row_count}}" style="position: absolute; z-index: 1;" class="card mb-4">
                                                                <div id="listBody{{$row_count}}" class="list-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">cost</p>
                                                            <input value="{{$pitem->unit_cost}}" onkeyup="calRowTotal({{$row_count}})" id="cost{{$row_count}}" name="cost[]" class="number-separator form-control" value="" placeholder="" @if(!($purchase->status==1)) disabled @endif>
                                                        </div>
                                                        @if($type==2)
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Curr Price</p>
                                                            <input onkeyup="calLoss({{$row_count}})" id="cur_cost{{$row_count}}" name="curr_price[]" class="number-separator form-control" value="" placeholder="" @if(!($purchase->status==1)) disabled @endif>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-1 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                                            <input value="{{$pitem->quantity}}" pattern="[0-9]{10}" onkeyup="calRowTotal({{$row_count}})" id="qty{{$row_count}}" name="qty[]" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 45) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" value="" placeholder="" @if(!($purchase->status==1)) disabled @endif>
                                                        </div>
                                                        @if($type==2)
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Trade Loss</p>
                                                            <input value="{{$pitem->td_loss}}" onkeyup="calRowTotal({{$row_count}})" id="td_loss{{$row_count}}" name="td_loss[]" class="number-separator form-control" value="" placeholder="" @if(!($purchase->status==1)) disabled @endif>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                            <p class="card-text col-title mb-md-50 mb-0">Total</p>
                                                            <input style=" border: none;background-color: transparent;resize: none;outline: none;" id="rowTotal{{$row_count}}" name="rowTotal[]" class=" form-control" value="{{$pitem->unit_cost*$pitem->quantity}} PKR">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25">
                                                        <svg onclick="deleteItem({{$row_count}})" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x cursor-pointer font-medium-3">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings cursor-pointer more-options-dropdown me-0" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <circle cx="12" cy="12" r="3">
                                                                </circle>
                                                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                                </path>
                                                            </svg>
                                                            <div class="dropdown-menu dropdown-menu-end item-options-menu p-50" aria-labelledby="dropdownMenuButton">
                                                                <div class="mb-1">
                                                                    <label for="discount-input" class="form-label">Discount</label>
                                                                    <input value="{{$pitem->trade_discount}}" name="trade_discount[]" type="number" class="form-control" id="discount-input" value="0">
                                                                </div>
                                                                <div class="form-row mt-50"></div>
                                                                <div class="dropdown-divider my-1"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <button type="button" class="btn btn-outline-primary btn-apply-changes waves-effect">Apply</button>
                                                                    <button type="button" class="btn btn-outline-secondary waves-effect">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            $row_count=$row_count+1
                                            @endphp
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div id="itemRows" class="row mt-1">
                                        <div class="col-12 px-0">
                                            <button @if (isset($purchase)) @if(!($purchase->status==1)) disabled @endif @endif id="addNewBtn" type="button" class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-25">
                                                    <line x1="12" y1="5" x2="12" y2="19">
                                                    </line>
                                                    <line x1="5" y1="12" x2="19" y2="12">
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
                                                <input type="hidden" name="total_amount" id="amount_feild" @if(isset($purchase)) value="{{$purchase->total}}" @endif>
                                                <p class="invoice-total-title">Total:</p>
                                                <p id="totalAmount" class="invosice-total-amount">{{ isset($purchase)? number_format( $purchase->total).' PKR' :'0 PKR'}}</p>
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
                                    @if (isset($purchase))
                                    @if ($purchase->status == 1)
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="post" class="btn btn-success me-2">Post</button>
                                        <button type="submit" name="action" value="cancel" class="btn btn-danger me-2">Cancel</button>
                                        <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
                                    </div>
                                    @elseif($purchase->status == 3)
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="unpost" class="btn btn-danger me-2">Un Post</button>
                                    </div>
                                    @endif

                                    @else
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                    @endif

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
    var rowId = 0;
    $(document).ready(function() {

        $('.select2-selection__arrow').hide();
    });

    $(document).on('change', '#supplier_id', function() {

        console.log("supplier_changed");


    });

    $('#addNewBtn').click(function() {

        console.log('ad-new item');
        var count = $(".repeater-wrapper > *").length;
        if (count > 0) {
            var rows = $(".repeater-wrapper > *");
            var last = rows[count - 1];
            rowId = $(last).attr('id');
            rowId = parseInt(rowId) + 1;
            console.log(rowId);

        } else {
            rowId = 0;
        }
        // console.log('count: '+count);

        // rowId = count;
        var maarkup = `<div id="${rowId}" class="row">
                        <div class="mt-3 col-12 d-flex product-details-border position-relative pe-0">
                            <div class="row py-2">
                                    <div class="col-lg-1 col-12 my-lg-0 my-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Item Id</p>
                                    <input name="item_id[]" id ="passId${rowId}" type="number" class="form-control" value="" placeholder="" onkeyup="getItemsById(${rowId},this.value)">
                                    <input name="item_id[]" id="item_id${rowId}" type="hidden" class="form-control"
                                                                    value="" placeholder="" >
                                    </div>
                                <div class="col-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Item Name</p>
                                    
                                    <input autocomplete="off" id="itemBox${rowId}" class=" form-control" autocomplete="off"
                                        placeholder="Enter Item"
                                        @if($type==1) onkeyup="getItems(${rowId})" @else onkeyup="getInvItems(${rowId})" @endif
                                        >
                                    <div class="list-type" id="list${rowId}" style="position: absolute; z-index: 1;"
                                        class="card mb-4">
                                        <div id="listBody${rowId}" class="list-group">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12 my-lg-0 my-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Cost</p>
                                    <input onkeyup="calRowTotal(${rowId})" id="cost${rowId}" name="cost[]"  class="number-separator form-control" value=""
                                        placeholder="">
                                </div>
                                @if($type==2)
                                                    
                                    <div class="col-lg-2 col-12 my-lg-0 my-2">
                                        <p class="card-text col-title mb-md-2 mb-0">Curr Price</p>
                                        <input  onkeyup="calLoss(${rowId})"  id="cur_cost${rowId}"
                                            name="curr_price[]" 
                                            class="number-separator form-control" value=""
                                            placeholder="">
                                    </div>
                                                                                   
                                @endif
                                <div class="col-lg-1 col-12 my-lg-0 my-2">
                                    <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                    <input   onkeyup="calRowTotal(${rowId})" id="qty${rowId}" name="qty[]"
                                        type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"class="form-control" value=""
                                        placeholder="">
                                </div>
                                @if($type==2)
                                                    
                                    <div class="col-lg-2 col-12 my-lg-0 my-2">
                                        <p class="card-text col-title mb-md-2 mb-0">Trade Loss</p>
                                        <input value="0" onkeyup="calRowTotal(${rowId})" id="td_loss${rowId}"
                                            name="td_loss[]" 
                                            class="number-separator form-control" value=""
                                            placeholder="">
                                    </div>
                                                                   
                                @endif
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
                                            <input name="trade_discount[]" type="number" class="form-control"
                                                id="discount-input" value="0">
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
        var cost = ($('#cost' + rowId).val());
        var type = $('#tran_type').val();
        var cost = Number(cost.replace(/[^0-9.-]+/g, ""));
        var cost = parseFloat(cost);

        var old = $("#rowTotal" + rowId).val();
        old = Number(old.replace(/[^0-9.-]+/g, ""));
        var total = qty * cost;
        $("#rowTotal" + rowId).val(total.toLocaleString('en-US') + " PKR");

        var subTotal = $("#totalAmount").text();
        subTotal = Number(subTotal.replace(/[^0-9.-]+/g, ""));
        var sum = parseFloat(subTotal) + parseFloat(total) - parseFloat(Number(old));
        $("#totalAmount").text(sum.toLocaleString('en-US') + " PKR");
        $("#amount_feild").val(sum.toFixed(2));
        console.log(sum);
        if (type == 2) {
            console.log(type);
            calLoss(rowId)
        }

    }



    function rePrint() {

        console.log('what is to be reprinted');
        // window.open({{ url('/test-pdf') }});

    }

    function getInvItems(id) {

        console.log('function callled');
        var letters = $('#itemBox' + id).val();
        if (letters.length < 2) {
            $('#cost' + rowId).val("");
            $('#qty' + rowId).val("");
            $('#cur_cost' + rowId).val("");
            $('#rowTotal' + rowId).val("");
            $('#td_loss' + rowId).val("");
            return;
        }
        console.log(letters);
        var investor_id = $("#select2-basic").val();
        console.log(investor_id);
        var supplier_id = $('#supplier_id').val();
        $.ajax({
            url: "{{ route('get-investor-items') }}",
            type: "GET",
            data: {
                key: letters,
                investor_id: investor_id,
                supplier_id:supplier_id
            },
            success: function(dataResult) {

                $("#listBody" + id).empty();
                console.log('recv2');
                console.log(dataResult);
                var i;
                for (i = 0; i < dataResult.length; i++) {
                    var item = dataResult[i].item;
                    console.log(item);
                    markup = `<button id = "btnItem` + item.id +
                        `"type="button" class="list-group-item list-group-item-action" onclick="setText(` +
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

    }


    function getItemsById(rowID, itemId) {
        console.log("getting by id");
        var supplier_id = $('#supplier_id').val();
        if (itemId.length < 1) {
            $('#cost' + rowID).val("");
            $('#passId' + rowID).val("");
            $('#qty' + rowID).val("");
            $('#cur_cost' + rowID).val("");
            $('#rowTotal' + rowID).val("");
            $('#td_loss' + rowID).val("");
            $('#itemBox' + rowID).val("");
            return;
        }
        $.ajax({
            url: "{{route('get-items-by-id')}}",
            type: "GET",
            data: {
                item_id: itemId,
                supplier_id: supplier_id,
            },
            success: function(dataResult) {

                console.log('recv1');
                console.log(dataResult);
                $("#itemBox" + rowId).val(dataResult.name);
                $("#passId" + rowId).val(dataResult.id);
                $("#item_id" + rowId).val(dataResult.id);
                // var investor_id = $("#select2-basic").val();
                // var type = $('#tran_type').val();

                // if (type == 2) {

                //     getLastPp(dataResult.id, investor_id);
                // }


            },
            error: function(xhr, status, error) {

                var err = eval("(" + xhr.responseText + ")");
                console.log(err);

            },
        });
    }

    function getItems(id) {


        // console.log(set.id);
        var letters = $('#itemBox' + id).val();
        var supplier_id = $('#supplier_id').val();
        if (letters.length < 2) {
            $('#cost' + id).val("");
            $('#passId' + id).val("");
            $('#qty' + id).val("");
            $('#cur_cost' + id).val("");
            $('#rowTotal' + id).val("");
            $('#td_loss' + id).val("");

            return;
        }
        
        $.ajax({
            url: "{{ route('get-items') }}",
            type: "GET",
            data: {
                key: letters,
                supplier_id: supplier_id,
            },
            success: function(dataResult) {
                $("#listBody" + id).empty();
                console.log('recv1');
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

        console.log("removing");
        var rowId = id;


        var row_total = $("#rowTotal" + rowId).val();
        row_total = Number(row_total.replace(/[^0-9.-]+/g, ""));

        var subTotal = $("#totalAmount").text();
        subTotal = Number(subTotal.replace(/[^0-9.-]+/g, ""));
        var sum = parseFloat(subTotal) - parseFloat(Number(row_total));
        $("#totalAmount").text(sum.toLocaleString('en-US') + " PKR");
        $("#amount_feild").val(sum.toFixed(2));

        $('#' + id).remove();



    }


    $(".content-wrapper").click(function(event) {
        console.log('clicked');
        var myClass = $(event.target).hasClass("list-group-item");
        if (myClass == true) {
            console.log("you clicked menu");

        } else {
            $(".list-type").hide();
        }
    });

    function getLastPp(itemId, investor_id) {
        $.ajax({
            url: "{{ route('get-last-purchase')}}",
            type: "GET",
            data: {
                item_id: itemId,
                investor_id: investor_id
            },
            success: function(dataResult) {



                $("#cost" + rowId).val(parseFloat(dataResult).toLocaleString('en-US'));


            },
            error: function(xhr, status, error) {

                var err = eval("(" + xhr.responseText + ")");
                console.log(err);
                alert(err);
            },
        });

    }

    function setText(item, rowId) {
        // var item = JSON.parse(item);
        console.log($('#btnItem' + item).text());
        $("#itemBox" + rowId).val($('#btnItem' + item).text());
        $("#passId" + rowId).val(item);
        $("#item_id" + rowId).val(item);
        $("#list" + rowId).hide();
        var investor_id = $("#select2-basic").val();
        var type = $('#tran_type').val();
        console.log(type);
        if (type == 2) {

            getLastPp(item, investor_id)
            // $.ajax({
            //     url: "{{ route('get-last-purchase')}}",
            //     type: "GET",
            //     data: {
            //         item_id: item,
            //         investor_id: investor_id
            //     },
            //     success: function(dataResult) {

            //         console.log('recv1');
            //         console.log(dataResult);

            //         $("#cost" + rowId).val(parseFloat(dataResult).toLocaleString('en-US'));


            //     },
            //     error: function(xhr, status, error) {

            //         var err = eval("(" + xhr.responseText + ")");
            //         console.log(err);
            //         alert(err);
            //     },
            // });

        }
        $('#qty' + rowId).val("");
        $('#cur_cost' + rowId).val("");
        $('#rowTotal' + rowId).val("");
        $('#td_loss' + rowId).val("");

    }

    function calLoss(id) {
        console.log('lssigfdf');
        var orgCost = $("#cost" + id).val();
        var qty = $("#qty" + id).val();
        var curCost = $("#cur_cost" + id).val();
        orgCost = Number(orgCost.replace(/[^0-9.-]+/g, ""));
        curCost = Number(curCost.replace(/[^0-9.-]+/g, ""));
        var loss = (orgCost - curCost) * qty;
        console.log(loss);
        $("#td_loss" + id).val(loss.toLocaleString('en-US'));



    }
</script>
@endsection