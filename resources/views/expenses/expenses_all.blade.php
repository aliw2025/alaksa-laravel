@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="">Expenses</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class=""  method="GET" autocomplete="on" action="{{route('show-expenses-post')}}">
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
                                        <option value="">all</option>
                                            @foreach($investors as $inv)
                                            <option value="{{$inv->id}}">{{$inv->investor_name}}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="">
                                        <span class="title">head</span>
                                        <select  onchange="getSubHeads()" class="form-select" name="head_id" id="head_id">
                                            <option value="">all</option>
                                            @foreach($heads as $head)
                                            <option value="{{$head->id}}">{{$head->name}}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="">
                                        <span class="title">sub head</span>
                                        <select class="form-select" name="sub_head_id" id="sub_head_id">
                                           
                                        </select>   
                                    </div>
                                </div>
                                <div class="col-2">
                                <div class="">
                                    <span class="title">status</span>
                                    <select class="form-select" name="status_id" id="">
                                    <option value="">all</option>
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
                        
                    <div class="row mt-2">
                        <div  class="col-12 table-responsive ">
                            @if(isset($expenses))
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">description</th>  
                                        <th scope="col">head</th>
                                        <th scope="col">subhead</th>    
                                        <th scope="col">Total</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="inventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($expenses as $exp)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$exp->description}}</td>
                                        <td>{{$exp->head->name??""}}</td>
                                        <td>{{$exp->subHead->sub_head_name??""}}</td>
                                        <td>{{ number_format($exp->amount) }}</td>
                                        <td>{{$exp->transaction_status->desc}}</td>
                                        <td>{{date('d-m-Y', strtotime($exp->date))}}</td>
                                        
                                        <td><a style="text-decoration: none;color:black" href="{{route('expense.show',$exp->id)}}"><i data-feather='eye'></i></a></td>
                                    </tr>
                                    @php
                                        $count = $count+1
                                    @endphp

                                    @endforeach
                                 
                                </tbody>
                            </table>
                            <div class="row my-2">
                                <div class="col-6">
                                    
                                </div>
                                {{-- @dd($expenses) --}}
                                <div class="col-6 d-flex justify-content-end">
                                    {{ $expenses->links() }}
                                </div>
                              
                            </div>
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
                getSubHeads();
            });

        });
        
        function getSubHeads() {
            console.log('getting sub heads');
            var head_id = $('#head_id').val();
            console.log('head_id:'+head_id);
            
            $.ajax({
                url: "{{ url('get-sub-heads') }}/",
                type: "GET",
                data: {
                    id: head_id,
                },
                success: function(dataResult) {
                    $("#sub_head_id").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    var markup = `<option value="">all</option>`;
                    $("#sub_head_id").append(markup);
                   
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<option value="`+item.id+`">`+item.sub_head_name+`</option>`;
                        $("#sub_head_id").append(markup);
                    }
                },
                error: function(xhr, status, error) {},
            });
           
        }
       
    </script>
@endsection
