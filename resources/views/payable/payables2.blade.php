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
                                @foreach ($leadger as $pay)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $pay->account->account_name }}</td>
                                        <td>{{ number_format($pay->value) }}</td>
                                        <td>{{ $pay->date }}</td>
                                        @if($pay->transaction_type=="App\Models\Purchase")
                                        <td><a style="text-decoration: none;color:black"
                                            href="{{ route('purchase.show', $pay->transaction_id) }}"><i
                                                data-feather='eye'></i></a></td>
                                           <td>
                                            {{$pay->transaction}}
                                           </td>
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
