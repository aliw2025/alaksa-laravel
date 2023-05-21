@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="">Payables</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($suppliers as $sup)
                            @if (count($sup->investor_purchases($id)) > 0)
                                <h4 class="mt-1">Supplier : {{ ucfirst($sup->name) }}</h4>
                                <p class="mt-1">Purchases</p>
                                <div class="row mt-2">
                                    <div class="col-12 table-responsive ">
                                        <table id="payables-table" class="table">
                                            <thead class="thead-dark">
                                                <tr style="background-color:red !important;">
                                                    <th style="width: 2px !important">#</th>
                                                    <th scope="col">Purchase No</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="inventory-iems-body" id="nventory-iems-body">
                                                @php
                                                    $count = 1;
                                                @endphp
                                                @foreach ($sup->investor_purchases($id) as $pur)
                                                    @php
                                                        $l = $pur->leadgerEntries->first->value;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $pur->purchase_no }}</td>
                                                        <td>{{ number_format($pur->total )}}</td>
                                                        <td>{{ $pur->purchase_date }}</td>
                                                        <td><a style="text-decoration: none;color:black"
                                                                href="{{ route('purchase.show', $pur->id) }}"><i
                                                                    data-feather='eye'></i></a></td>
                                                    </tr>
                                                    @php
                                                        $count = $count + 1;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-end">
                                                {{-- <p class="">Total : {{ $sup->investor_purchases($id)->sum('total') }} --}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="">Return Losses</p>
                                <div class="row mt-2">
                                    <div class="col-12 table-responsive ">
                                       
                                        @if (count($sup->investor_Sup_expenses($id)) > 0)
                                            <table id="payables-table" class="table">
                                                <thead class="thead-dark">
                                                    <tr style="background-color:red !important;">
                                                        <th style="width: 2px !important">#</th>
                                                        <th scope="col">Loss No</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                                    @php
                                                        $count = 1;
                                                    @endphp
                                                   
                                                    @foreach ($sup->investor_Sup_expenses($id) as $pay)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $pay->id }}</td>
                                                            <td>{{ number_format($pay->value) }}</td>
                                                            <td>{{ $pay->date }}</td>
                                                            <td><a style="text-decoration: none;color:black"
                                                                    href="{{ route('expense.show', $pay->transaction_id) }}"><i
                                                                        data-feather='eye'></i></a></td>
                                                        </tr>
                                                        @php
                                                            $count = $count + 1;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                     
                                    </div>
                                </div>

                                {{-- payments --}}
                                <p class="">Payments</p>
                                <div class="row mt-2">
                                    <div class="col-12 table-responsive ">
                                        @if (count($sup->investor_payments($id)) > 0)
                                            <table id="payables-table" class="table">
                                                <thead class="thead-dark">
                                                    <tr style="background-color:red !important;">
                                                        <th style="width: 2px !important">#</th>
                                                        <th scope="col">Payment No</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                                    @php
                                                        $count = 1;
                                                    @endphp
                                                    {{-- @dd($sup->investor_payments($id)); --}}
                                                    @foreach ($sup->investor_payments($id) as $pay)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $pay->payment_no }}</td>
                                                            <td>{{ number_format($pay->amount) }}</td>
                                                            <td>{{ $pay->payment_date }}</td>
                                                            <td><a style="text-decoration: none;color:black"
                                                                    href="{{ route('supplierPayment.show', $pay->id) }}"><i
                                                                        data-feather='eye'></i></a></td>
                                                        </tr>
                                                        @php
                                                            $count = $count + 1;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-end">
                                                @php
                                                    $total_pur = $sup->investor_purchases($id)->where('type','=',1)->sum('total');
                                                    $total_ret = $sup->investor_purchases($id)->where('type','=',2)->sum('total');
                                                    $paid = $sup->investor_payments($id)->sum('amount');
                                                    $ret_loss = $sup->investor_Sup_expenses($id)->sum('value')*-1;

                                                    $rem = $total_pur+$total_ret+$ret_loss - $paid;
                                                @endphp
                                                <p class="">Total Purchases : {{number_format( $total_pur)}}
                                                {{-- <p> Payment paid : {{ $sup->investor_payments($id)->sum('amount') }}</p> --}}
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                {{-- <p class="">Total Returns : {{ $sup->investor_purchases($id)->sum('total') }} --}}
                                                <p> Total Returns : {{ number_format($total_ret *-1 )}}</p>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                {{-- <p class="">Total Returns losses : {{ $sup->investor_purchases($id)->sum('total') }} --}}
                                                <p> Total Return losses : {{ number_format($ret_loss )}}</p>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                {{-- <p class="">Total Due payments : {{ $sup->investor_purchases($id)->sum('total') }} --}}
                                                <p> Payment paid : {{number_format($paid) }}</p>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                {{-- <p class="">Total Due payments : {{ $sup->investor_purchases($id)->sum('total') }} --}}
                                                <p> Due  : {{number_format($rem) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).ready(function() {
                console.log('i am datatable');
                // $('#payables-table').DataTable();
            });

        });
    </script>
@endsection
