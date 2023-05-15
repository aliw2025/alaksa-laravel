@extends('template.header')
@section('section')
<div class="content-wrapper container-xxl p-0">
    <div class="content-body">
        <section class="invoice-add-wrapper">
            <div class="row invoice-add">
                <!-- Invoice Add Left starts -->
                <div class="col-xl-12 col-md-12 col-12">
                    <form class="" method="POST" autocomplete="on" action="{{ isset($expense)?route('expense.update',$expense->id):route('expense.store') }}">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            @if(isset($expense))
                            {{ method_field('PUT') }}
                            @endif
                            @if(isset($expense))
                                <input type="hidden" name="expense_id" id="" value="{{$expense->id}}" >
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
                                            Expense</h4>
                                            @if(isset($expense))
                                                @if(($expense->status==2))
                                                <h4 style="color:red">Cancelled</h4>
                                                @endif
                                            @endif
                                       
                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            @csrf
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Date:</span>
                                           
                                            <input @if(isset($expense)) value="{{ $expense->date }}" @endif  name="date" type="date" class="form-control" @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif >

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="title">Investor:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                               
                                                <select @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif name="investor_id" class=" select2 select2-hidden-accessible form-control invoice-edit-input" id="select2-basic" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                    @foreach ($investors as $investor)
                                                    <option @if(isset($expense)) @if($expense->investor_id == $investor->id) selected @endif @endif value="{{ $investor->id }}">
                                                        {{ $investor->investor_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                               
                                            </div>
                                        </div>
                                        <div class="mt-1 d-flex align-items-center justify-content-between">
                                            <span class="title">Head:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <select @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif name="head_id" class=" select2 select2-hidden-accessible form-control invoice-edit-input" id="head_id" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                    @if(isset($heads))
                                                        @foreach($heads as $h)
                                                            <option @if(isset($expense)) @if($expense->head_id == $h->id) selected @endif @endif value="{{ $h->id }}">
                                                                {{ $h->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-1 d-flex align-items-center justify-content-between">
                                            <span class="title">sub Head:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">

                                                <select @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif name="sub_head_id" class="form-control" id="shead_id" aria-hidden="true">
                                                    @if(isset($expense))
                                                    <option value="{{ $expense->head_id }}">
                                                        {{ $expense->subHead->sub_head_name}}
                                                    </option>
                                                    @endif
                                                    <!-- @if(isset($sheads))
                                                            @foreach ($sheads as $sh)
                                                                <option value="{{ $sh->id }}">
                                                                    {{ $sh->sub_head_name }}
                                                                </option>
                                                            @endforeach
                                                            @endif -->
                                                </select>

                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Account</span>

                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center">
                                                <select @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif name="acc_type" class="form-select" aria-label="Default select example">

                                                    <!-- <option value="1"> Cash</option> -->
                                                    @foreach ($bank_acc as $acc)
                                                    <option @if(isset($expense)) @if($expense->account_id == $acc->id) selected @endif @endif value="{{ $acc->id }}">
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
                                                            <input @if (isset($expense)) value="{{ $expense->amount }}" @endif id="cost0" name="amount" class="@error('amount') is-invalid @enderror number-separator form-control" placeholder="" @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif>
                                                            @error('amount')
                                                                <div class="alert alert-danger">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-9 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Description</p>
                                                            <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="1" id="note" @if(isset($expense)) @if(!($expense->status==1)) disabled @endif @endif>@if (isset($expense)){{ $expense->description }}@endif 
                                                            </textarea>
                                                            @error('description')
                                                                <div class="alert alert-danger">{{$message}}</div>
                                                            @enderror
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
                                @if (isset($expense))
                                    @if ($expense->status == 1)
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="post" class="btn btn-success me-2">Post</button>
                                        <button type="submit" name="action" value="cancel" class="btn btn-danger me-2">Cancel</button>
                                        <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
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

<script>
    var rowId = 0;
    $(document).ready(function() {

        console.log('outside');
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
        var headId = $('#head_id').val();
        getSubHeads(headId);

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

</script>
@endsection