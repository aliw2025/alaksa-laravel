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
                        
                    <div class="row mt-2">
                        <div  class="col-12 table-responsive ">
                            @if(isset($expenses))
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">description</th>  
                                        <th scope="col">Total</th>
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
                                        <td>{{ number_format($exp->amount) }}</td>
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
            });

        });

        function getRUserByName() {
            
            var key = $('#rec_of_name').val();
            $("#rec_of_id").val("");
            console.log(key);
            if (key.toString().length < 3) {

                return;
            }
            $.ajax({
                url: "{{ url('get-recovery-off') }}/",
                type: "GET",
                data: {
                    key: key,
                },
                success: function(dataResult) {
                    $("#rec_list_body").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<button id = "recItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setRecUser(` +
                            item.id + `)">` + item.name + `</button>`;
                        $("#rec_list_body").append(markup);
                    }
                },
                error: function(xhr, status, error) {},
            });
            $("#rec_list").show();
        }
        function setRecUser(user){

            $("#rec_of_name").val($('#recItem' + user).text());
            $("#rec_of_id").val(user);
            $("#rec_list").hide();
        }
    </script>
@endsection
