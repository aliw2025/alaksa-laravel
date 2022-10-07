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

                    <div class="row ">
                   
                        <div  class="col-12 table-responsive ">
                            <table id="payables-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Purchase No</th>
                                        <th scope="col">Remaining Amount</th>  
                                        <th scope="col">total Amount</th>
                                        <th scope="col">Supplier</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($payables as $payables)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$payables->purchase->purchase_no}}</td>
                                        <td>{{$payables->remaining_value}}</td>
                                        <td>{{$payables->total_value}}</td>
                                        <td>{{$payables->purchase->supplier}}</td>
                                       
                                      
                                    </tr>
                                    @php
                                        $count = $count+1
                                    @endphp

                                    @endforeach
                                 
                            
                                </tbody>
                            </table>
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
            $('#payables-table').DataTable();
        });

    });
</script>
@endsection