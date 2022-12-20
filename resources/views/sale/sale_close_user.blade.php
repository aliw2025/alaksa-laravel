

@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Sale Close</h4>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-6">
                            <label class="mt-1" for="" >User </label>
                             <input type="text"  class="form-control" value="{{$user->name}}" >
                            {{-- <label class="mt-1" for="" >take back from alp </label>
                            <input type="text"  class="form-control" >
                            <label class="mt-1" for="" >investor will receive </label>
                            <input type="text"  class="form-control" >
                            <label class="mt-1" for="" >alp recived </label>
                            <input type="text"  class="form-control"> --}}
                        </div>
                        <div class="col-6">
                            {{-- <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select> --}}
                        

                        </div>
                        
                    </div>
                   
                    <div class="row mt-1">

                        <div class="col-12">
                                <table class="table">
                                    <th>investor</th>
                                    <th>transaction type</th>
                                    <th>account</th>
                                    <th>amount</th>

                                    <tbody >
                                        @foreach($transactions as $tran)
                                        <tr>
                                            <td>    
                                                {{$tran->investor->investor_name}}
                                            </td>
                                            <td>    
                                                {{$tran->transaction_type}}
                                            </td>
                                            <td>    
                                                {{$tran->account->account_type==1?"cash":'bank'}}
                                            </td>
                                            <td>    
                                                {{$tran->value}}
                                            </td>
                                            
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                        </div>

                    </div>
                    <div class="row mt-1">

                        <div class="col-12">
                            <p> bank balance : {{$bank_sum}}</p>
                            <p> cash balance : {{$cash_sum}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-1">

                            <button class="btn btn-primary"> Sale Close</button>

                        </div>
                    </div>

                   

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