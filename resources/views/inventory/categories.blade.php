@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="">
        
        <div class="">
            <div class="row">
                <div class="col-9 ">
                    <div class="card">
                    <div class="card-header d-flex ">
                        <div>
                            <h4 class="text-center">Categories</h4>
                        </div>
                    </div>
                        <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Categor Name</th>
                                        <!-- <th scope="col">email</th>
                                        <th scope="col">Designation</th> -->
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                    $count = 1
                                    @endphp
                                    @foreach($categories as $cat)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$cat->category_name}}</td>
                                        <td>
                                            <a style="text-decoration: none;color:black" href="{{route('create-property',$cat->id)}}"><i data-feather='edit'></i></a>
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
                <div class="col-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header d-flex justify-content-center">
                                    <div>
                                        <h4 class="text-center">Add New Category</h4>
                                    </div>
                                </div>
                                <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('category.store')}}">
                                    @csrf
                                    <label class="form-label" for="">Category Name </label>
                                    <input type="text" class="form-control" name="category_name" >
                                   
                                    <button class="mt-1 btn btn-primary mt-2" >save</button>
                                    
                                </form>
                            </div>  
                        </div>
                       
                </div>
            </div>


        </div>

    </div>

</div>
@endsection