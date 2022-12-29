@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Salary Calculation</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class=""  method="GET" autocomplete="on" action="{{route('get-salary-post')}}">
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
                                    <span class="title">employee</span>
                                    <select class="form-select" name="user_id" id="">
                                        @foreach($users as $inv)
                                        <option value="{{$inv->id}}">{{$inv->name}}</option>
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
                        {{-- @dd($salary    ) --}}
                        <div  class=" mt-2 col-12 table-responsive ">
                            @if(isset($salary))
                            
                            <p> salary : {{$salary}}</p>
                            <p>comissions: {{$com_am}}</p>
                            <p>total : {{$com_am+$salary}}</p>
                           
                            
                           
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