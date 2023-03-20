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
                                    <h4 class="text-center">Account Balances </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordionExample">
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($investors as $inv)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne{{ $count }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{ $count }}" aria-expanded="true"
                                                aria-controls="collapseOne{{ $count }}">
                                                {{ $inv->investor_name }}
                                            </button>
                                        </h2>
                                        <div id="collapseOne{{ $count }}" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne{{ $count }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @foreach ($bank_accounts as $bnk)
                                                    @php
                                                        $investors_bank =  \App\Models\GLeadger::where('account_id','=',$bnk->id)->where('investor_id','=',$inv->id)->sum('value');
                                                
                    
                                                            // dd($transactions);
                                                    @endphp
                                                    <p>{{ $bnk->account_name }}: {{$investors_bank??0 }} </p>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $count += 1;
                                    @endphp
                                @endforeach
                                    {{-- @foreach ($investors as $inv)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne{{ $count }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne{{ $count }}" aria-expanded="true"
                                                    aria-controls="collapseOne{{ $count }}">
                                                   Balances
                                                </button>
                                            </h2>
                                            <div id="collapseOne{{ $count }}" class="accordion-collapse collapse"
                                                aria-labelledby="headingOne{{ $count }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach ($bank_accounts as $bnk)
                                                        @php
                                                            $investors_bank =  \App\Models\GLeadger::where('account_id','=',$bnk->id)->sum('value');
                                                    
                                                                // dd($transactions);
                                                        @endphp
                                                        <p>{{ $bnk->account_name }}: {{$investors_bank??0 }} </p>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $count += 1;
                                        @endphp
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
