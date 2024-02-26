@extends('template.header')
@section('section')
<div class="content-wrapper container-xxl p-0">
    <div class="content-body">
        <section class="invoice-add-wrapper">
            <div class="row invoice-add">
                <!-- Invoice Add Left starts -->
                <div class="col-xl-12 col-md-12 col-12">
                    <form class="" method="POST" autocomplete="on" action="{{ isset($expensePayment)? route('expensePayment.update',$expensePayment->id):route('expensePayment.store') }}">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            @if(isset($expensePayment))
                            {{ method_field('PUT') }}
                            @endif
                            @if(isset($expensePayment))
                            <input type="hidden" name="expensePayment_id" id="" value="{{$expensePayment->id}}">
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
                                        <h4 style="text-decoration: underline">
                                            Expense Payment</h4>
                                        @if(isset($expensePayment))
                                        @if(($expensePayment->status==2))
                                        <h4 style="color:red">Cancelled</h4>
                                        @elseif(($expensePayment->status==3))
                                        <h4 style="color:green">Posted</h4>
                                        @endif
                                        @endif
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
                                                <input style="font-size: 12px" @if (isset($expensePayment)) disabled value="{{ $expensePayment->payment_no }}" @endif name="purchaseId" type="text" class="form-control invoice-edit-input" placeholder="">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Date:</span>

                                            <input value="{{ isset($expensePayment)? $expensePayment->payment_date :now()->format('Y-m-d') }}" name="payment_date" type="date" class="form-control invoice-edit-input" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="title">Investor:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <select name="investor_id" id="investor_id" class=" select2 select2-hidden-accessible form-control invoice-edit-input" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>
                                                    @foreach ($investors as $investor)
                                                    <option value="{{ $investor->id }}" @if(isset($expensePayment)) @if($expensePayment->investor_id == $investor->id) selected @endif @endif >
                                                        {{ $investor->investor_name }}
                                                    </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Account</span>

                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select name="acc_type" class="form-select" aria-label="Default select example" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>
                                                    @foreach ($bank_acc as $acc)
                                                    <option @if(isset($expensePayment)) @if($expensePayment->account_id==$acc->id) selected @endif @endif value="{{ $acc->id }}">
                                                        {{ $acc->account_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Head</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <select name="supplier" id="head_id" class="@error('supplier') is-invalid @enderror form-select select2 select2-hidden-accessible" aria-label="Default select example" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>
                                                    @foreach ($expense_heads as $head)
                                                    <option @if(isset($expensePayment)) @if($expensePayment->supplier_id==$sup->id) selected @endif @endif value="{{ $head->id }}">{{ $head->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('supplier')
                                                <div class="alert alert-danger"> {{$message}}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Sub Head</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <select name="supplier" id="shead_id" class="@error('supplier') is-invalid @enderror form-select select2 select2-hidden-accessible" aria-label="Default select example" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>
                                                  
                                                </select>
                                                @error('supplier')
                                                <div class="alert alert-danger"> {{$message}}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">OutStanding Amount</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <input type="text" class="form-control" id="outstanding_amount" disabled>

                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Transaction Expense</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <input @if (isset($expensePayment)) value="{{ number_format($expensePayment->transaction_charges)}}" @else value="0" @endif  type="text" class="number-separator form-control" id="tran_expense" name="tran_exp" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>

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
                                                        <div class="col-3 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Amount</p>
                                                            <input @if (isset($expensePayment)) value="{{number_format($expensePayment->amount )}}" @endif id="cost0" name="amount" class="@error('amount') is-invalid @enderror number-separator form-control" placeholder="" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>
                                                            @error('amount')
                                                            <div class="alert alert-danger"> {{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-9 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Note</p>
                                                            <input @if (isset($expensePayment)) value="{{ $expensePayment->note }}" @endif id="cost0" name="note" type="text" class="form-control" value="" placeholder="" @if(isset($expensePayment)) @if($expensePayment->status!=1) disabled @endif @endif>
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
                                    @if (isset($expensePayment))
                                    @if ($expensePayment->status == 1)
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="post" class="btn btn-success me-2">Post</button>
                                        <button type="submit" name="action" value="cancel" class="btn btn-danger me-2">Cancel</button>
                                        <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
                                    </div>
                                    @elseif($expensePayment->status == 3)
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
@if(Session::has('error_m'))
<script>
    $(document).ready(function() {
        toastr.error("{{Session::get('error_m')}}", "Failed!", {
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
        getExpenseNetPayable();
    });

    $('#investor_id').on('change', function() {

        getExpenseNetPayable();

    });

    $('#supplier_id').on('change', function() {

        getExpenseNetPayable();

    });

    function getSubHeads(headId){
        
        $.ajax({
            url: "{{ route('get-sub-heads') }}",
            type: "GET",
            data: {
                id: headId,
            },
            success: function(dataResult) {

                $("#shead_id").empty();
               
                var i;
                for (i = 0; i < dataResult.length; i++) {
                    var item = dataResult[i];
                    var count = i + 1;
                    console.log(item);
                    markup = `<option value='` + item.id + `'>` + item.sub_head_name + `</option>`
                    $("#shead_id").append(markup);
                }
            },
            error: function(xhr, status, error) {

                var err = eval("(" + xhr.responseText + ")");
                console.log(err);
                alert(err);
            },
        });
    }

    $(document).on('change', '#head_id', function() {

        var headId = $(this).val();
        getSubHeads(headId);

    });

    function getExpenseNetPayable() {

        var investorId = $('#investor_id').val();
        var supplierId = $('#supplier_id').val();

        $.ajax({
            url: "{{route('supplier-net-payable')}}",
            type: 'GET',
            data: {
                investor_id: investorId,
                supplier_id: supplierId
            },
            success: function(data) {
                // Handle successful response here

                console.log('Success:', data);
                $('#outstanding_amount').val(data);
            },
            error: function(xhr, status, error) {
                // Handle error here
                console.error('Error:', error);
            }
        });

    }
</script>
@endsection