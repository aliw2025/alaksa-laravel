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
                    <form class=""  method="GET" autocomplete="on" action="{{route('search-payables-post')}}">
                        @csrf
                        <div class="row d-flex align-items-center">
                            
                            <div class="col-2">
                                <div class="">
                                    <span class="title">From Date:</span>
                                    <input @if(isset($from_date)) value="{{$from_date}}" @endif name="from_date" type="date"
                                        class="form-control invoice-edit-input "
                                        >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="">
                                    <span class="title">To Date:</span>
                                    <input @if(isset($to_date)) value="{{$to_date}}" @endif name="to_date" type="date"
                                        class="form-control invoice-edit-input "
                                        >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="">
                                    <span class="title">Investor</span>
                                    <select class="form-select" name="investor_id" id="">
                                    <option></option>   
                                        @foreach($investors as $inv)
                                        <option value="{{$inv->id}}">{{$inv->investor_name}}</option>
                                        @endforeach
                                       

                                    </select>   
                                </div>
                            </div>
                            <!-- <div class="col-2">
                                <div class="">
                                    <span class="title">status</span>
                                    <select class="form-select" name="status_id" id="">
                                    <option></option>   
                                        @foreach($statuses as $st)
                                        <option value="{{$st->id}}">{{$st->desc}}</option>
                                        @endforeach
                                       

                                    </select>   
                                </div>
                            </div> -->
                            <div class="col-2">
                                <div class="">
                                    <span class="title">supplier</span>
                                    <select class="form-select" name="supplier_id" id="">
                                     <option></option>
                                        @foreach($suppliers as $sup)
                                        <option value="{{$sup->charOfAccounts[0]->id}}">{{$sup->name}}</option>
                                        @endforeach
                                       

                                    </select>   
                                </div>
                            </div>
                           
                            <div class="col-2 ">
                                <Button type="submit" name="action" value="report" class="mt-1 btn btn-relief-primary">Report</Button>
                                <Button type="submit" name="action" value="pdf" class="mt-1 btn btn-relief-secondary">PDF</Button>

                            </div>
                            
                        </div>


                    </form>
                    <div class="row ">
                        
                        <div  class=" mt-2 col-12 table-responsive ">
                            @if(isset($gl))
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>

                                        <th>Investor</th>  
                                        <th scope="col">Supplier</th>
                                        <th>Type</th>
                                        <th>Total</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="inventory-iems-body">
                                    @php
                                        $count = 1;
                                      
                                    @endphp
                                    @foreach ($gl as $pur)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$pur->investor->investor_name}}</td>
                                        <td>{{$pur->account->owner->name??""}}</td>
                                        <td>{{$pur->transaction_type=='App\Models\Purchase'? 'purchase':'return loss'}}</td>
                                        <td>{{ number_format( $pur->value * -1)}}</td>
                                        <td>{{date('d-m-Y', strtotime($pur->date))}}</td>
                                       
                                        <td><a style="text-decoration: none;color:black" href="{{ $pur->transaction_type=='App\Models\Purchase'?route('purchase.show',$pur->transaction_id):route('expense.show',$pur->transaction_id)}}"><i data-feather='eye'></i></a></td>
                                       
                                      
                                    </tr>
                                    @php
                                        $count = $count+1;
                                        
                                    @endphp

                                    @endforeach
                                 
                                </tbody>
                            </table>
                            <div class="mt-4">

                            </div>
                            
                        <div class="mt-4">
                            {{$gl->links()}}
                            </div>
                           
                            @endif
                        </div>


                        @if(isset($sum))
                        <div class="mt-4">
                                
                                <p>total Payable : {{number_format( $sum *-1)}}</p>
                               
                                                                
                            </div>
                            @endif
                          
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