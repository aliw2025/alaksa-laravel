@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="">

        <div class="">
            <div class="row">
                <div class="col-12 ">
                    <div class="">
                        <div class="card-header d-flex ">
                            <div>
                                <h4 class="text-center">Account Balances Investor wise </h4>
                            </div>
                        </div>
                        <div class="">
                            <div class="row" id="accordionExample">
                                @php
                                $count = 1;
                                $grand_total = 0;
                                $total_cash = 0;
                                $total_bnk = 0;
                                @endphp
                                @foreach ($investors as $inv)
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="accordion-header " id="headingOne{{ $count }}">
                                                <!-- <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne{{ $count }}" aria-expanded="true"
                                                    aria-controls="collapseOne{{ $count }}">
                                                   
                                                </button> -->
                                                {{ $inv->investor_name }}
                                            </h2>
                                        </div>
                                        <div class="card-body">
                                            <div id="collapseOne{{ $count }}" class="accordion-collapse " aria-labelledby="headingOne{{ $count }}" data-bs-parent="#accordionExample">

                                                <div class="accordion-body">
                                                    @php
                                                    $total = 0;
                                                    @endphp
                                                    @foreach ($bank_accounts as $bnk)
                                                    @php
                                                        
                                                    $investors_bank = \App\Models\GLeadger::where('account_id','=',$bnk->id)->where('investor_id','=',$inv->id)->sum('value');
                                                    $total += $investors_bank;
                                                    if($bnk->account_type ==1){
                                                    $total_cash += $investors_bank;
                                                    }else{
                                                    $total_bnk += $investors_bank;
                                                    }
                                                    // dd($transactions);
                                                    @endphp
                                                    <p><span style="font-weight: bold;"> {{ $bnk->account_name }}: </span> {{ number_format($investors_bank??0)}} </p>
                                                    @endforeach
                                                    <hr>
                                                    <p>Total : {{number_format($total) }} </p>
                                                    @php
                                                    $grand_total +=$total;
                                                    @endphp

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $count += 1;
                                @endphp
                                @endforeach
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                                    <h4>Account balances</h4>
                                        </div>
                                        <div class="card-body">
                                        @php
                                                    $all_total = 0;
                                                    @endphp
                                                    @foreach ($bank_accounts as $bnk)
                                                    @php
                                                        $all_bank = \App\Models\GLeadger::where('account_id','=',$bnk->id)->sum('value');
                                                        $all_total += $all_bank;
                                                    
                                                    @endphp
                                                    <p><span style="font-weight: bold;"> {{ $bnk->account_name }}: </span> {{ number_format($all_bank??0)}} </p>
                                                    @endforeach
                                                    <hr>
                                                    <p>Total : {{number_format($all_total) }} </p>
                                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>summary</h4>
                                        </div>
                                        <div class="card-body">
                                            <p> Total available cash: {{ number_format($total_cash??0)}} </p>
                                            <p> Total Bank + valets : {{ number_format($total_bnk??0)}} </p>

                                            <p> Total available balance: {{ number_format($grand_total??0)}} </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection