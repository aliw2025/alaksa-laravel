@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Purchase# {{$purchase->purchase_no}}</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">

                        <div class="col-12 table-responsive ">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>

                                        <th scope="col">name</th>
                                        <th scope="col">unit cost</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">total</th>



                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">

                                    @php
                                    $count = 1
                                    @endphp
                                    @foreach ($purchase_items as $item)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->pivot->unit_cost}}</td>
                                        <td>{{$item->pivot->quantity}}</td>
                                        <td>{{$item->pivot->quantity * $item->pivot->unit_cost}}</td>


                                    </tr>
                                    @php
                                    $count = $count+1
                                    @endphp

                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <p><span style="font-weight: bold;"> Total: </span> {{$purchase->total}} </p>

                                </div>

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
</script>
@endsection