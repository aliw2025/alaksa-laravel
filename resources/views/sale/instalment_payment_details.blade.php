

@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Payment Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div  class="col-12 table-responsive ">
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">payment #</th>  
                                        <th scope="col">Total</th>
                                        <th>Note</th>
                                        <th scope="col">Date</th>
                                        <th>Status</th>
                                        <th scope="col">Action</th>
                                        
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($instalment_payments as $pay)
                                    
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$pay->id}}</td>
                                        <td> {{ number_format($pay->amount) }}</td>
                                        <td>{{$pay->notes}}</td>
                                        <td>{{date('d-m-Y', strtotime($pay->payment_date));
                                            }}</td>  
                                            <td>{{$pay->transaction_status->desc??''}}</td>
                                             <td>
                                                <a style="text-decoration: none;color:black" href="{{route('pay-instalment-new-show',$pay->id)}}"><i data-feather='eye'></i></a>
                                                
                                            </td>    
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
            
            $('#investor-table').DataTable();
        });

    });
</script>
@endsection