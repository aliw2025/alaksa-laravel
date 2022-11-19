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
                                            <label class="mb-1">Type last digits of invoice</label>
                                            <input id="invoice_no" onkeyup="getInvoices()"
                                                value="{{ isset($sale) ? $sale->invoice_no : '' }}" class="form-control"
                                                type="text">
                                            <div class="list-type" id="list" style="position: absolute; z-index: 1;"
                                                class="card mb-4">
                                                <div style="
                                                    height:150px;
                                                    overflow-y: scroll;"
                                                    id="listBody" class="list-group ">

                                                </div>
                                            </div>
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
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Due Amount</th>
                                            <th scope="col">Amount Paid</th>
                                            <th scope="col">Remaining Amount</th>
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
                                        @if (isset($instalments))
                                            @foreach ($instalments as $pur)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $pur->due_date }}</td>
                                                    <td>{{ $pur->amount }}</td>
                                                    <td> {{ $pur->amount_paid }}</td>
                                                    <td> {{ $pur->amount - $pur->amount_paid }}</td>

                                                    <td>
                                                        @if ($pur->instalment_paid)
                                                            @php
                                                                $paid = $paid + $pur->amount;
                                                            @endphp
                                                            <div class="badge-wrapper me-1">
                                                                <span
                                                                    class="p-1 px-2 badge rounded-pill badge-light-success">Paid</span>
                                                            </div>
                                                        @else
                                                            <div class="badge-wrapper me-1">
                                                                <span
                                                                    class="p-1 badge rounded-pill badge-light-danger">Pending</span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a  data-id="{{ $pur->id }}"
                                                            class=" abc btn btn-primary waves-effect waves-float waves-light"
                                                            data-bs-toggle="modal" data-bs-target="#addNewCard">
                                                            Pay
                                                        </a>
                                                        {{-- <a href="{{ route('recieve-instalment',$pur->id) }}" >pay</a> --}}
                                                    </td>
                                                </tr>
                                                @php
                                                    $total = $total + $pur->amount;
                                                    $count = $count + 1;
                                                @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <div class="me-2">
                                    <p>Total : {{ $total }}</p>
                                    <p>Paid : {{ $paid }}</p>
                                    <p>Remaining : {{ $total - $paid }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="row container">
                    <form action="{{route('pay-instalment')}}">

                        <input id="ins_id" type="hidden" name="id" type="text" class="form-control">
                        <div class="col-12 my-1 ">
                            <label> Amount: </label>
                            <input name="amount_paid" type="text" class="form-control">
                        </div>
                        <div class="col-12 my-1">
                            <label> Note: </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-12 my-1 d-flex justify-content-end">
                            <button data-bs-dismiss="modal" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).on("click", ".abc", function() {
            var insId = $(this).data('id');
            // alert(insId);
            $("#ins_id").val(insId);
        });
        $(document).ready(function() {

            $(document).ready(function() {
                console.log('i am datatable');
                // $('#investor-table').DataTable();
            });

        });


        function getInvoices() {
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

        function setInvoice(item) {

            $("#invoice_no").val($('#cusItem' + item).text());
            $("#list").hide();
            window.location.href = "{{ url('get-sale-instalments/') }}?id=" + item;
            // $("#customer_id").val(item);
            // $("#invoice_no").hide();
        }
    </script>
@endsection
