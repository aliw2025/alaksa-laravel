@extends('template.header')
@section('section')
<div class="content-wrapper container-xxl p-0">
    <div class="content-body">
        <section class="invoice-add-wrapper">
            <div class="row invoice-add">
                <!-- Invoice Add Left starts -->
                <div class="col-xl-12 col-md-12 col-12">
                    <form class="" method="POST" autocomplete="on" action="{{ isset($investment)? route('investment.update',$investment->id):route('investment.store') }}">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            @if(isset($investment))
                            {{ method_field('PUT') }}
                            @endif
                            @if(isset($investment))
                                <input type="hidden" name="investment_id" id="" value="{{$investment->id}}">
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
                                            Add Balance</h4>
                                            @if(isset($investment))
                                                @if(($investment->status==2))
                                                    <h4 style="color:red">Cancelled</h4>
                                                @elseif(($investment->status==3))
                                                    <h4 style="color:green">Posted</h4>
                                                @endif
                                            @endif
                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            @csrf
                                           
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Date:</span>
                                            
                                            <input  value="{{ isset($investment)? $investment->date :now()->format('Y-m-d') }}"  name="date" type="date" class="form-control invoice-edit-input" @if(isset($investment)) @if($investment->status!=1) disabled @endif @endif>
                                            
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="title">Investor:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                               
                                                <select name="investor_id" class=" select2 select2-hidden-accessible form-control invoice-edit-input" id="select2-basic" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"  @if(isset($investment)) @if($investment->status!=1) disabled @endif @endif>
                                                    @foreach ($investors as $investor)
                                                    <option value="{{ $investor->id }}"  @if(isset($investment)) @if($investment->investor_id == $investor->id)  selected @endif @endif >
                                                        {{ $investor->investor_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                

                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Account</span>
                                           
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select name="acc_type" class="form-select" aria-label="Default select example"  @if(isset($investment)) @if($investment->status!=1) disabled @endif @endif>
                                                    @foreach ($bank_acc as $acc)
                                                    <option @if(isset($investment)) @if($investment->account_id==$acc->id) selected @endif @endif value="{{ $acc->id }}">
                                                        {{ $acc->account_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
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
                                                            <input @if (isset($investment))  value="{{ $investment->amount }}" @endif id="cost0" name="amount" class="@error('amount') is-invalid @enderror number-separator form-control" placeholder="" @if(isset($investment)) @if($investment->status!=1) disabled @endif @endif>
                                                            @error('amount')
                                                            <div class="alert alert-danger"> {{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-9 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Note</p>
                                                            <input @if (isset($investment))  value="{{ $investment->description }}" @endif id="cost0" name="description" type="text" class="form-control" value="" placeholder="" @if(isset($investment)) @if($investment->status!=1) disabled @endif @endif>
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
                                @if (isset($investment))
                                    @if ($investment->status == 1)
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="post" class="btn btn-success me-2">Post</button>
                                        <button type="submit" name="action" value="cancel" class="btn btn-danger me-2">Cancel</button>
                                        <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
                                    </div>
                                    @elseif($investment->status == 3)
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
    });
</script>
@endsection