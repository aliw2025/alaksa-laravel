@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="">

        <div class="">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header d-flex ">
                            <div>
                                <h4 class="text-center">Transfer Balance to company </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <form action="{{route('add-transfer-request')}}" method="POST" autocomplete="on">

                                <div class="row">
                                    @csrf
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4>Sender information</h4>
                                                <label for="">invesotor</label>
                                                <select class="form-control" name="inv_1" id="">
                                                    @foreach ($investors as $inv)
                                                    <option value="{{$inv->id}}">{{$inv->investor_name}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="">Account</label>
                                                <select class="form-control" name="bnk_1" id="">
                                                    @foreach ($ro_bank_accounts as $bnk2)
                                                    <option value="{{$bnk2->id}}">{{$bnk2->account_name}}</option>
                                                    @endforeach

                                                </select>
                                                <label for="">Amount</label>
                                                <input value="{{old('amount')}}" type="text" name="amount" id="" class="number-separator form-control @error('amount') is-invalid @enderror">
                                                @error('amount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h4>Reciever information</h4>
                                        <div class="col-6">
                                            {{-- <label for="">invesotor</label>
                                                <select class="form-control" name="inv_2" id="">
                                                    @foreach ($investors as $inv)
                                                        <option value="{{$inv->id}}">{{$inv->investor_name}}</option>
                                            @endforeach
                                            </select> --}}
                                            <label for="">Account</label>
                                            <select class="form-control" name="bnk_2" id="">
                                                @foreach ($bank_accounts as $bnk)
                                                <option value="{{$bnk->id}}">{{$bnk->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary">Transfer</button>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
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
@endsection