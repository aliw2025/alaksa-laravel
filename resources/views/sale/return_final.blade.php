

@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Return Adjustments</h4>
                    </div>
                </div>
                <div class="card-body">
                <form id="sale_form" method="POST"  autocomplete="on" action="{{route('post-return-adjustment') }}">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="sale_id" id="" value="{{$sale->id}}">
                        <div class="col-6">
                            <label class="mt-1" for="" >take back from investor </label>
                            <input name="take_back_inv"  type="text"  class="form-control" value="{{ number_format($cash_back_investor)}}">
                            <label class="mt-1" for="" >take back from alp </label>
                            <input name="take_back_alp" type="text"  class="form-control" value="{{ number_format($cash_back_company)}}">
                            <label class="mt-1" for="" >investor will receive </label>
                            <input name="give_back_inv" type="text"  class="form-control" value="{{ number_format($give_to_investor)}}">
                            <label class="mt-1" for="" >alp recived </label>
                            <input name="take_back_alp"  type="text"  class="form-control" value="{{ number_format($give_to_company)}}">
                            <label class="mt-1" for="" >TD Return </label>
                            <input name="take_back_alp"  type="text"  class="form-control" value="{{ number_format($sale->trade_discount)}}">
                        </div>
                        <div class="col-6">
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_back_inv" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                @foreach($bank_acc as $acc)
                                <option value="{{$acc->id}}">{{$acc->account_name}}</option>
                                @endforeach
                               

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_back_alp" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                @foreach($bank_acc as $acc)
                                <option value="{{$acc->id}}">{{$acc->account_name}}</option>
                                @endforeach

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_rcv_inv" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                @foreach($bank_acc as $acc)
                                <option value="{{$acc->id}}">{{$acc->account_name}}</option>
                                @endforeach
                                

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_rcv_alp" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                @foreach($bank_acc as $acc)
                                <option value="{{$acc->id}}">{{$acc->account_name}}</option>
                                @endforeach
                               

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_rcv_alp" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                @foreach($bank_acc as $acc)
                                <option value="{{$acc->id}}">{{$acc->account_name}}</option>
                                @endforeach
                               

                            </select>
                    
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="mt-1 btn btn-primary"> Save</button>

                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        $(document).ready(function() {
            
            $('#investor-table').DataTable();
        });

    });
</script>
@endsection