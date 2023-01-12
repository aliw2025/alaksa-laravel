@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form class="" method="POST" target="_blank" action="{{route('reprint-invoice',$sale->id)}}" autocomplete="on">
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
                                                    <input value={{$sale->marketingOfficer->name}} id="mar_of_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Recovery Officer: </span>
                                                    <input   value={{$sale->recoveryOfficer->name}} id="rec_of_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span  class="title">Inquiry Officer: </span>
                                                    <input   value={{$sale->inquiryOfficer->name}} id="rec_of_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">                     
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="title">Sale Type:</span>
                                                    <input value="{{$sale->sale_type==1?"Instalments":"Cash"}}" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <h4 style="text-decoration: underline">
                                               Sale</h4>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf
                                                <h4 class="invoice-title"> Sale #
                                                </h4>
                                                <input type="hidden" name="sale_id" value="{{$sale->id}}">
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <input id="search_inv"
                                                        value="{{$sale->invoice_no}}"
                                                        name="purchaseId"
                                                        type="text" class="form-control invoice-edit-input"
                                                        placeholder="" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Status:</span>
                                                
                                                    <input  value="{{ $sale->transaction_status->desc}}" id="sale_status"
                                                        name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                               
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                    <input   value="{{$sale->sale_date}} "id="sale_date" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                              
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Account</span>
                                                <input    id="sale_date" name="purchase_date" type="text"
                                                class="form-control invoice-edit-input" readonly="readonly">

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Investor:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                        <input   value="{{$sale->investor->investor_name}}" id="investor_name" name="purchase_date" type="text"
                                                            class="form-control invoice-edit-input" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class=" mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer ID:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                        <input   value="{{$sale->customer->id}}" id="customer_id" name="purchase_date" type="text"
                                                            class="form-control invoice-edit-input" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="mt-1 d-flex align-items-center justify-content-between">
                                                <span class="title">Customer Name:</span>
                                                    <input   value="{{$sale->customer->customer_name}}" id="customer_name" name="purchase_date" type="text"
                                                        class="form-control invoice-edit-input" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->
                                <hr class="invoice-spacing">
                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
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
                                            <td>1</td>
                                            <td>{{$sale->item_id}}</td>
                                            <td>{{$sale->item->name}}</td>
                                            <td>{{ number_format($sale->selling_price)}}</td>
                                            <td>{{$sale->plan}}</td>
                                            <td>{{$sale->markup}}</td>
                                        </tbody>
                                    </table>   
                                    
                                </div>     
                                <div class="container">
                                    <div  class="mt-1" id="instalment_sec">
                                        <div class="row mt-1">
                                            <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                <h4>Instalment details</h4>
                                                <div class="row d-flex align-items-center">
                                                    <div class="col-6  mt-1">
                                                        <p>Total Sum :</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input readonly id="total_sum"
                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                            name="total_sum" class="form-control"
                                                            value="{{number_format($sale->total)}}" >
                                                        {{-- <p id="total_sum_label"> 0</p> --}}
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center">
                                                    <div class="col-6  mt-1">
                                                        <p>Down Payment :</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input readonly id="down_payment"
                                                            style="border: none;background-color: transparent;resize: none;outline: none;"
                                                            name="down_payment"
                                                            class="number-separator form-control"
                                                            value="{{number_format($sale->downpayment)}}">
                                                        {{-- <p id="down_payment_label"> 0</p> --}}
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center ">
                                                    <div class="col-6 mt-1">
                                                        <p>instalments :</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input readonly id="instalments"
                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                            name="instalments" class=" form-control"
                                                            value="{{number_format($sale->plan)}}" >
                                                        {{-- <p id="instalments_label"> 0</p> --}}
                                                        
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center">
                                                    <div class="col-6 mt-1">
                                                        <p>instalments per Month :</p>
                                                    </div>
                                                    <div class="col-6  ">
                                                        <input readonly id="per_month"
                                                            style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                            name="instalment_per_month"
                                                            class=" number-separator form-control"
                                                            value="{{ number_format(($sale->total - $sale->downpayment) / $sale->plan) }}" >
                                                        {{-- <p id="per_month_label"> 0</p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <h4>Item details</h4>
                                                <div id="item-detail-sec" class="row">
                                                    {{-- style="border: none;background-color: transparent;resize: none;outline: none;" --}}

                                                    <div class="col-6">
                                                        <label class="form-slabel" for="">Serial /
                                                            IME#</label>
                                                        <input readonly 
                                                            @if (isset($sale)) value="{{ $sale->seriel_no }}" @endif
                                                            name='seriel_no' type="text"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="">Item
                                                            Name</label>
                                                        <input readonly 
                                                            @if (isset($sale)) value="{{ $sale->item->name }}" @endif
                                                            id="i_name" type="text"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label"
                                                            for="">Make</label>
                                                        <input readonly 
                                                            @if (isset($sale)) value="{{ $sale->item->make }}" @endif
                                                            id="i_make" type="text"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-slabel"
                                                            for="">Model</label>
                                                        <input readonly 
                                                            @if (isset($sale)) value="{{ $sale->item->model }}" @endif
                                                            id="i_model" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div id="custom-section" class="row">
                                                    @if (isset($sale))
                                                        @foreach ($sale->item->propertyValues as $prop)
                                                            <div class="col-6">
                                                                <label class="form-slabel"
                                                                    for="">{{ $prop->propertyName->property_name }}</label>
                                                                <input readonly  value="{{ $prop->prop_value }}"
                                                                    id="i_model" type="text"
                                                                    class="form-control">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="mt-2 row">

                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                @if($sale->status==3)
                                <div class="row p-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            {{-- onclick="returnSale()" --}}
                                            <button id="retBtn" 
                                                class="btn btn-primary me-2">Reprint</button>
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

 
@endsection
