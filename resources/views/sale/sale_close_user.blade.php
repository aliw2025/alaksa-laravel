

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
                            <label class="mt-1" for="" >User: </label>
                            <input type="text"  class="form-control mt-1" value="{{$user->name}}" >
                        </div>
                        <div class="col-3">
                            <label class="mt-1" for="" >Date: </label>
                            <input type="text"  class="form-control mt-1" value="{{ Carbon\Carbon::today()}}" >
                        </div>
                        <div class="col-3">
                           <button class="mt-4 btn btn-primary"> Populate </button>
                        </div>     
                    </div>
                    <div class="row mt-1">
                        <table id="investor-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th style="width: 2px !important">#</th>
                                    
                                    {{-- <th>Date</th> --}}
                                    <th>Transaction Type</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="inventory-iems-body" id="inventory-iems-body">
                                @php
                                    $count = 1
                                @endphp
                                
                                @foreach($transactions as $tran)
                                <tr>
                                    <td>{{$count}}</td>
                                    {{-- <td> {{ date('d-m-Y', strtotime($tran->date))}}</td> --}}
                                    <td> 
                                        @if($tran->transaction_type=="App\Models\Purchase")
                                        Purchase
                                        @elseif($tran->transaction_type=="App\Models\Sale")   
                                        Sale
                                        @elseif($tran->transaction_type=="App\Models\Expense")
                                        Expense
                                        @elseif($tran->transaction_type=="App\Models\Instalment") 
                                        Instalment
                                        @elseif($tran->transaction_type=="App\Models\InstalmentPayment") 
                                        Instalment Payment  
                                        @elseif($tran->transaction_type=="App\Models\Payable")
                                        Supplier Payment  
                                        @endif
                                    </td>
                                    <td>    
                                        {{$tran->account->account_type==1?"cash":'bank'}}
                                    </td>
                                    <td>    
                                        {{number_format($tran->value)}}
                                    </td>
                                    <td>
                                        @if($tran->transaction_type=="App\Models\Purchase")
                                        <a style="text-decoration: none;color:black"
                                            href="{{ route('purchase.show', $tran->transaction_id) }}"><i
                                                data-feather='eye'></i></a>
                                        @elseif($tran->transaction_type=="App\Models\Sale")   
                                        <a style="text-decoration: none;color:black"
                                            href="{{ route('sale.show', $tran->transaction_id) }}"><i
                                                data-feather='eye'></i></a>
                                        @elseif($tran->transaction_type=="App\Models\Expense")
                                        <a style="text-decoration: none;color:black"
                                            href="{{ route('instalment.show', $tran->transaction_id) }}"><i
                                                data-feather='eye'></i></a>
                                        @elseif($tran->transaction_type=="App\Models\Instalment") 
                                        <a style="text-decoration: none;color:black"
                                            href="{{ route('instalment.show', $tran->transaction_id) }}"><i
                                                data-feather='eye'></i></a>
                                        @elseif($tran->transaction_type=="App\Models\Payable")
                                        <a style="text-decoration: none;color:black"
                                            href="{{ route('payable.show', $tran->transaction_id) }}"><i
                                                data-feather='eye'></i></a>
                                        @elseif($tran->transaction_type=="App\Models\InstalmentPayment") 
                                         <a style="text-decoration: none;color:black"
                                             href="{{ route('show-instalment-payment', $tran->transaction_id) }}"><i
                                            data-feather='eye'></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $count = $count+1
                                @endphp

                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                   
                    <div class="row mt-1">

                        <div class="col-12">
                            <p> Total Bank Transactions : {{number_format($bank_sum) }}</p>
                            <p> Total Cash Transactions : {{number_format($cash_sum) }}</p>
                            <p> Total Bank Balance : {{number_format($bank_sum_all) }}</p>
                            <p> Total Cash Balance : {{ number_format($cash_sum_all) }}</p>
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
            
            // $('#investor-table').DataTable();
        });

    });
</script>
@endsection