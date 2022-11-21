@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Purchases</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">
                   
                        <div  class="col-12 table-responsive ">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Purchase NO</th>  
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                        
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="inventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($purchases as $pur)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$pur->purchase_no}}</td>
                                        <td>{{$pur->supplier}}</td>
                                        <td>{{$pur->purchase_date}}</td>
                                        <td><a style="text-decoration: none;color:black" href="{{route('purchase.show',$pur->id)}}"><i data-feather='eye'></i></a></td>
                                       
                                      
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
            $('#investor-table').DataTable();
        });

    });
</script>
@endsection