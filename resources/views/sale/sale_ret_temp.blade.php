@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="">Sale Return</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- action="{{ route('commission-report') }} --}}
                       
                            {{-- @csrf --}}
                            <div class="row d-flex align-items-center">
                                
                                <div class="col-3">
                                    <div class="">
                                        <span class="title">Sale No:</span>
                                        <input id="sale_no" name="from_date" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                               
                                <div class="col-2 ">
                                    <Button onclick="getSale()" class="mt-2 btn btn-relief-primary">Search</Button>
                                </div>

                            </div>
                        
                    <div class="row mt-2 ">
                        <div  class="col-12 table-responsive ">
                            <table  class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">invoice NO</th>  
                                        <th scope="col">Total</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="sale_body" id="sale_body">
                                   
                                </tbody>
                            </table>
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

        function getSale(){

            var inv = $('#sale_no').val();

            $.ajax({
                url: "{{ url('get-sale-no') }}/",
                type: "GET",
                data: {
                    key: inv,
                },
                success: function(dataResult) {
                    $("#sale_body").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        console.log(item);
                        markup = `<tr> 
                            <td>1</td>
                            <td>`+item.invoice_no +`</td>
                            <td>`+item.total +`</td>
                            <td>`+item.sale_date +`</td>
                            <td> <a href={{route('sale.create')}}>return</a></td>
                             </tr>`;
                        $("#sale_body").append(markup);
                    }
                },
                error: function(xhr, status, error) {},
            });
            $("#rec_list").show();

            console.log(inv);

        }

        // function getSale

        function getRUserByName() {

            var key = $('#rec_of_name').val();
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
