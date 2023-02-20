@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <form action="">
                        <label for="" >Customer</label>
                        <select class="mt-2 form-control" name="customer" id="">
                            @foreach ($customers as $cus)
                                <option value="{{$cus->id}}">{{$cus->customer_name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="mt-2 btn btn-primary"> Select</button>
                    </form>
        
                </div>
            </div>
        </div>
    </div>
   
    <div class="">
        
        <div class="">
            <div class="row">
                <div class="col-9 ">
                    <div class="card">
                    <div class="card-header d-flex ">
                        <div>
                            <h4 class="text-center">Customer Docs</h4>
                        </div>
                    </div>
                        <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">name</th>
                                        <!-- <th scope="col">email</th>
                                        <th scope="col">Designation</th> -->
                                        

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                    $count = 1
                                    @endphp
                                    @foreach ($files as $file)

                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>{{$file->db_name}}</td>
                                            <td><a href="{{$file->file_path}}">file</a></td>
                                        </tr>
                                        @php
                                        $count += 1
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header d-flex justify-content-center">
                                    <div>
                                        <h4 class="text-center">Add New Document</h4>
                                    </div>
                                </div>
                                <form   enctype="multipart/form-data" method="POST" class="form form-vertical" autocomplete="on" action="{{route('customer-file-upload')}}">
                                    @csrf
                                    <label class="form-label" for="">Customer Name </label>
                                    <select class=" form-control" name="customer_id" id="">
                                        @foreach ($customers as $cus)
                                            <option value="{{$cus->id}}">{{$cus->customer_name}}</option>
                                        @endforeach
                                    </select>
                                    <label   class="mt-1 form-label" for="">file Name </label>
                                    <input type="text" class="form-control" name="db_name"  >
                                    <label class="form-label mt-1"  for="">file </label>
                                    <input type="file" class="form-control" name="file_name" >
                                    <button class="btn btn-primary mt-2" >save</button>
                                    
                                </form>
                            </div>  
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection