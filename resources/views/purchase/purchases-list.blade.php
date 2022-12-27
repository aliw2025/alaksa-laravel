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
                    <form class=""  method="GET" autocomplete="on" action="{{route('get-purchases-post')}}">
                        @csrf
                        <div class="row d-flex align-items-center">
                            
                            <div class="col-2">
                                <div class="">
                                    <span class="title">From Date:</span>
                                    <input name="from_date" type="text"
                                        class="form-control invoice-edit-input date-picker flatpickr-input"
                                        readonly="readonly">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="">
                                    <span class="title">To Date:</span>
                                    <input name="to_date" type="text"
                                        class="form-control invoice-edit-input date-picker flatpickr-input"
                                        readonly="readonly">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="">
                                    <span class="title">Investor</span>
                                    <select class="form-select" name="investor_id" id="">
                                        @foreach($investors as $inv)
                                        <option value="{{$inv->id}}">{{$inv->investor_name}}</option>
                                        @endforeach
                                    </select>   
                                </div>
                            </div>


                           
                            <div class="col-2 ">
                                <Button type="submit" class="mt-1 btn btn-relief-primary">Report</Button>
                            </div>

                        </div>


                    </form>
                    <div class="row ">
                        
                        <div  class=" mt-2 col-12 table-responsive ">
                            @if(isset($purchases))
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Purchase NO</th>  
                                        <th scope="col">Supplier</th>
                                        <th>Total</th>
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
                                        <td>{{$pur->psupplier->name}}</td>
                                        <td>{{$pur->total}}</td>
                                        <td>{{$pur->purchase_date}}</td>
                                        <td><a style="text-decoration: none;color:black" href="{{route('purchase.show',$pur->id)}}"><i data-feather='eye'></i></a></td>
                                       
                                      
                                    </tr>
                                    @php
                                        $count = $count+1
                                    @endphp

                                    @endforeach
                                 
                            
                                </tbody>
                            </table>
                            {{$purchases->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/resources/js/scripts/pages/app-invoice.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {

        $(document).ready(function() {
            console.log('i am datatable');
            $('#investor-table').DataTable();
        });

    });
</script>
@endsection