@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="">Instalments</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <form action="">
                                    <div class="row my-1">
                                        <div class="col-6">

                                            <input id="invoice_no" onkeyup="getInvoices()" value="{{ $sale->invoice_no }}" class="form-control" type="text">
                                            <div class="list-type" id="list" style="position: absolute; z-index: 1;"
                                                class="card mb-4">
                                                <div id="listBody" class="list-group">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class=" btn btn-primary me-2">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row ">

                            <div class="col-12 table-responsive ">
                                <table id="investor-table" class="table">
                                    <thead class="thead-dark">
                                        <tr style="background-color:red !important;">
                                            <th style="width: 2px !important">#</th>
                                            {{-- <th scope="col">invoice NO</th>   --}}
                                            <th scope="col">Amount</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="inventory-iems-body" id="inventory-iems-body">
                                        @php
                                            $count = 1;
                                            $total = 0;
                                            $paid = 0;
                                            $rem = 0;
                                        @endphp
                                        @foreach ($instalments as $pur)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $pur->amount }}</td>
                                                <td>{{ $pur->due_date }}</td>
                                                <td>
                                                    @if ($pur->instalment_paid)
                                                    @php
                                                         $paid = $paid+$pur->amount;
                                                    @endphp
                                                    <div class="badge-wrapper me-1">
                                                        <span class="p-1 px-2 badge rounded-pill badge-light-success">Paid</span>
                                                      </div>
                                                     
                                                    @else
                                                    <div class="badge-wrapper me-1">
                                                        <span  class="p-1 badge rounded-pill badge-light-danger">Pending</span>
                                                      </div>
                                            
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="">pay</a>
                                                </td>
                                            </tr>
                                            @php
                                                $total = $total+$pur->amount;
                                                $count = $count + 1;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <div class="me-2">
                                    <p>Total : {{$total}}</p>
                                    <p>Paid : {{$paid}}</p>
                                    <p>Remaining : {{$total-$paid}}</p>
                                </div>
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
                console.log('i am datatable');
                // $('#investor-table').DataTable();
            });

        });
        function getInvoices(){
            // $("#customer_id").val("");
            var key = $('#invoice_no').val();
            //lo
            if (key.toString().length < 3) {

                return;
            }

            $.ajax({
                url: "{{ route('get-invoices') }}",
                type: "GET",
                data: {
                    key: key,
                },
                success: function(dataResult) {
                    $("#listBody").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "cusItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setInvoice(` +
                            item.id + `)">` + item.invoice_no + `</button>`;
                        $("#listBody").append(markup);
                    }
                    // $("#customer_name").val(dataResult.customer_name);

                },
                error: function(xhr, status, error) {
                    // $("#customer_name").val("");
                    // $("#customer_id").val("");
                },
            });
            $("#list").show();
        }
        function setInvoice(item){

            $("#invoice_no").val($('#cusItem' + item).text());
            $("#list").hide();
            window.location.href = "{{ url('get-sale-instalments/')}}/"+item;
            // $("#customer_id").val(item);
            // $("#invoice_no").hide();
        }
    </script>
@endsection
