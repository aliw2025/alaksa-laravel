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
                    @foreach($suppliers as $sup)
                    <h4 class="mt-1">{{$sup->name}}:</h4>
                    <div class="row mt-2">
                        <div  class="col-12 table-responsive ">
                            <table id="payables-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Purchase No</th>
                                        <th scope="col">Remaining Amount</th>  
                                        <th scope="col">total Amount</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($sup->investor_purchases($id) as $pur)
                                        @php
                                        $l = $pur->leadgerEntries->first->value
                                        @endphp
                                     
                                    <tr>
                                       <td>{{$count}}</td>
                                        <td>{{$pur->purchase_no}}</td>
                                        <td>{{$l->value}}</td>
                                        <td></td>
                                        <td>{{$pur->psupplier->name}}</td>
                                        <td> <a href="#">pay</a> </td>
                                    </tr>
                                    @php
                                        $count = $count+1
                                    @endphp
                                    @endforeach
                                </tbody>
                                <h4 class="">Purchases :{{$sup->investor_purchases($id)->sum('total')}}</h4>
                                
                            </table>

                            

                        </div>
                    </div>
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