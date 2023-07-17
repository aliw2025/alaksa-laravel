@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Instalment Payments</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class=""  method="GET" autocomplete="on" action="{{route('instalment-payment-report-post')}}">
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
                           
                            <div class="col-2 ">
                                <span  class="title">Customer Name:</span>
                                <input @if(isset($customer_name)) value="{{$customer_name}}" @endif name="customer_name" type="text" class="form-control">
                            </div>
                            <div class="col-2 ">
                                <span class="title">Customer ID:</span>
                                <input @if(isset($customer_id)) value="{{$customer_id}}" @endif name="customer_id" type="text" class="form-control">
                            </div>
                            <div class="col-2 ">
                                <span class="title">Invoice No:</span>
                                <input @if(isset($invoice_no)) value="{{$invoice_no}}" @endif name="invoice_no" type="text" class="form-control">
                            </div>
                            <div class="col-2 ">
                                <span class="title">Instalment No:</span>
                                <input @if(isset($instalment_no)) value="{{$instalment_no}}" @endif name="instalment_no" type="text" class="form-control">
                            </div>
                            <div class="col-2 ">
                                <span class="title">Instalment id:</span>
                                <input @if(isset($instalment_id)) value="{{$instalment_id}}" @endif name="instalment_id" type="text" class="form-control">
                            </div>
                            <div class="col-2">
                                <div class="">
                                    <span class="title">status</span>
                                    <select class="form-select" name="status_id" id="">
                                    <option></option>   
                                        @foreach($statuses as $st)
                                        <option value="{{$st->id}}">{{$st->desc}}</option>
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
                            @if(isset($instalmentPayments))
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">sale No</th>
                                        <th>Investor</th>  
                                        <th scope="col">Customer</th>
                                        <th>Instalment id</th>
                                        <th>Intalment no</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th> 
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="inventory-iems-body">
                                    @php
                                        $count = 1;
                                      
                                    @endphp
                                    @foreach ($instalmentPayments as $pur)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$pur->instalment->sale->invoice_no}}</td>
                                        <td>{{$pur->instalment->sale->investor->investor_name}}</td>
                                        <td>{{$pur->instalment->sale->customer->customer_name}}</td>
                                        <td>{{$pur->instalment->id}}</td>
                                        <td>{{$pur->instalment->instalment_no}}</td>
                                        <td>{{ number_format( $pur->amount)}}</td>                                       
                                        <td>{{$pur->transaction_status->desc??''}}</td>
                                        <td>{{date('d-m-Y', strtotime($pur->payment_date))}}</td>
                                       
                                        <td><a style="text-decoration: none;color:black" href="{{route('pay-instalment-new-show',$pur->id)}}"><i data-feather='eye'></i></a></td>
                                       
                                      
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
                                {{$instalmentPayments->links()}}
                            </div>
                           
                            @endif
                        </div>


                        @if(isset($sum))
                        <div class="mt-4">
                                
                                <p>payment total : {{number_format( $sum)}}</p>
                                                                
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