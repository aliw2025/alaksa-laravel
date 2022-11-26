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
                        <form class="" target="_blank" method="POST" autocomplete="on" action="{{ route('commission-report') }}">
                            @csrf
                            <div class="row d-flex align-items-center">
                                <div class="col-2 ">
                                    <span class="title">Commission Type:</span>
                                    <select id="commission_type" name="commission_type" class="form-select"
                                        aria-label="Default select example">
                                        <option value="1">Sale</option>
                                        <option value="2">Recovery</option>
                                        <option value="3">All</option>
                                    </select>
                                </div>
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


                                <div class="col-2 ">
                                    <span class="title">User:</span>
                                    <input id="rec_of_id"  placeholder="User" name="user_id" type="hidden" class="form-control">
                                    <input id="rec_of_name" onkeyup="getRUserByName()" placeholder="User" name="user" type="text" class="form-control">
                                    <div class="list-type" id="rec_list" style="position: absolute; z-index: 1;"
                                        class="card mb-4">
                                        <div id="rec_list_body" class="list-group">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <Button type="submit" class="mt-1 btn btn-relief-primary">Report</Button>
                                </div>

                            </div>


                        </form>
                  
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
