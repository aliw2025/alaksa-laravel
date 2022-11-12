@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="">Commissions</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 ">
                                <span class="title">Commission Type:</span>
                                <select id="sale_type" name="sale_type" class="form-select"
                                    aria-label="Default select example">
                                    <option value="1">Sale</option>
                                    <option value="2">Recovery</option>
                                    <option value="3">All</option>

                                </select>

                            </div>
                            <div class="col-2">
                                <div class="">
                                    <span class="title">Date:</span>
                                    <input name="sale_date" type="text"
                                        class="form-control invoice-edit-input date-picker flatpickr-input"
                                        readonly="readonly">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="">
                                    <label for="startDate">Start</label>
                                    <input id="startDate" class="form-control " type="time" />
                                </div>
                            </div>
                           

                        </div>


                        {{-- 
                    <div class="row ">
                        <div  class="col-12 table-responsive ">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">invoice NO</th>  
                                        <th scope="col">Total</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="inventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($sales as $pur)

                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$pur->invoice_no}}</td>
                                        <td>{{$pur->total}}</td>
                                        <td>{{$pur->sale_date}}</td>
                                        <td><a style="text-decoration: none;color:black" href="{{route('get-sale-instalments',$pur->id)}}"><i data-feather='eye'></i></a></td>
                                    </tr>
                                    @php
                                        $count = $count+1
                                    @endphp

                                    @endforeach
                                 
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
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
