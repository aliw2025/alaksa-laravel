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
                        <table id="payables-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th style="width: 2px !important">#</th>
                                    <th scope="col">Transaction No</th>
                                    <th>Transaction Type</th>
                                    <th scope="col">Supplier</th>
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
                                @foreach ($leadger as $pay)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        @if ($pay->transaction_type == 'App\Models\Purchase')
                                            <td>
                                                @php
                                                    $a = $pay->transactionable()->get();
                                                    $va = $pay->transactionable()->first();
                                                @endphp
                                                @foreach ($a as $b)
                                                    {{ $b->purchase_no }}
                                                @endforeach
                                            </td>
                                        @else
                                            <td>
                                                @php
                                                    $a = $pay->transactionable()->get();
                                                    $va = $pay->transactionable()->first();
                                                @endphp
                                                @foreach ($a as $b)
                                                    {{ $b->id }}
                                                @endforeach
                                            </td>
                                        @endif
                                        <td>{{ $pay->transaction_type }}</td>
                                        <td>{{ $pay->account->owner->name }}</td>
                                        <td>{{ number_format($pay->value) }}</td>
                                        <td>{{ $pay->date }}</td>

                                        @if ($pay->transaction_type == 'App\Models\Purchase')
                                            <td><a style="text-decoration: none;color:black"
                                                    href="{{ route('purchase.show', $pay->transaction_id) }}"><i
                                                        data-feather='eye'></i></a></td>
                                        @elseif($pay->transaction_type == 'App\Models\Payable')
                                            <td><a style="text-decoration: none;color:black"
                                                    href="{{ route('payable.show', $pay->transaction_id) }}"><i
                                                        data-feather='eye'></i></a></td>
                                            <td>
                                            @else
                                            <td><a style="text-decoration: none;color:black" href="#"><i
                                                        data-feather='eye'></i></a></td>
                                            <td>
                                        @endif
                                    </tr>
                                    @php
                                        $count = $count + 1;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>

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
