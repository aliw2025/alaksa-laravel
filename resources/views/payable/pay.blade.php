@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form class="" method="POST" autocomplete="on" action="{{ route('payable.store') }}">
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
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf
                                                <h4 class="invoice-title">Payment #</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    {{-- <div class="input-group-text">
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
                                                    </div> --}}
                                                    <input style="font-size: 12px"
                                                        @if (isset($payable)) disabled
                                                            value="{{ $payable->payment_no }}" @endif
                                                        name="purchaseId" type="text"
                                                        class="form-control invoice-edit-input" placeholder="">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                @if (isset($payable))
                                                    <input value="{{ $payable->payment_date }}" disabled name="payment_date"
                                                        type="text" class="form-control invoice-edit-input ">
                                                @else
                                                    <input name="payment_date" type="text"
                                                        class="form-control invoice-edit-input date-picker flatpickr-input"
                                                        readonly="readonly">
                                                @endif

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Investor:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    @if (isset($payable))
                                                        <input disabled value="{{ $payable->investor->investor_name }}"
                                                            name="payment_date" type="text"
                                                            class="form-control invoice-edit-input ">
                                                    @else
                                                        <select name="investor_id"
                                                            class=" select2 select2-hidden-accessible form-control invoice-edit-input"
                                                            id="select2-basic" data-select2-id="select2-basic"
                                                            tabindex="-1" aria-hidden="true">
                                                            @foreach ($investors as $investor)
                                                                <option value="{{ $investor->id }}">
                                                                    {{ $investor->investor_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="title">Account</span>
                                                {{-- <select class="form-control" name="supplier" id=""></select> --}}
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    <select
                                                        @if (isset($payable)) disabled
                                                value="{{ $payable->investor->investor_name }}" @endif
                                                        name="acc_type" class="form-select"
                                                        aria-label="Default select example">

                                                        <option value="1"> Cash</option>
                                                        <option value="4"> Bank Account</option>

                                                    </select>
                                                </div>

                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="title">Supplier</span>
                                                {{-- <select class="form-control" name="supplier" id=""></select> --}}
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">
                                                    @if (isset($payable))
                                                        <input  value="{{ $payable->supplier_val->name}}"
                                                        disabled
                                                            name="payment_date" type="text"
                                                            class="form-control invoice-edit-input ">
                                                    @else
                                                        <select name="supplier" class="form-select"
                                                            aria-label="Default select example">

                                                            @foreach ($suppliers as $sup)
                                                                <option value="{{ $sup->id }}">{{ $sup->name }}
                                                                </option>
                                                            @endforeach


                                                        </select>
                                                    @endif

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
                                                    <div class="col-12  product-details-border position-relative pe-0">
                                                        <div class="row py-2">

                                                            <div class="col-3 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Amount</p>
                                                                <input 
                                                                    @if (isset($payable)) disabled
                                                                value="{{ $payable->amount }}" @endif
                                                                    id="cost0" name="amount" 
                                                                    class="number-separator form-control" placeholder="">
                                                            </div>
                                                            <div class="col-9 my-lg-0 my-2">

                                                                <p class="card-text col-title mb-md-2 mb-0">Note</p>
                                                                <input
                                                                    @if (isset($payable)) disabled
                                                                value="{{ $payable->note }}" @endif
                                                                    id="cost0" name="note" type="number"
                                                                    class="form-control" value="" placeholder="">
                                                                {{-- <textarea name="note" class="form-control" rows="1" id="note"></textarea> --}}

                                                            </div>


                                                        </div><s></s>

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
                                        @if (isset($payable))
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-primary">Re Print</button>
                                            </div>
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
    <script>
        var rowId = 0;
        $(document).ready(function() {

            $('.select2-selection__arrow').hide();
        });
    </script>
@endsection
