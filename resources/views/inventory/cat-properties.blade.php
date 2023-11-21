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
                                <h4 class="text-center">{{$category->category_name}} properties</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Property Name</th>
                                        <!-- <th scope="col">email</th>
                                        <th scope="col">Designation</th> -->
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                    $count = 1
                                    @endphp
                                    @foreach($properties as $prop)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$prop->property_name}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a style="text-decoration: none;color:black" href="{{ route('categoryProperty.edit', $prop->id) }}"><i data-feather='edit'></i></a>
                                                <form method="POST" action="{{ route('categoryProperty.destroy', $prop->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="border: none; background-color: transparent;">
                                                        <i data-feather='trash-2'></i>
                                                    </button>
                                                </form>

                                            </div>

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
                                    <h4 class="text-center"> {{isset($categoryProperty)? 'Update Property':'Add New Property'}} </h4>
                                </div>
                            </div>
                            @if(isset($categoryProperty))
                            <div class="d-flex justify-content-end">
                                <a href="{{route('create-property',$categoryProperty->cat_id)}}">add new</a>
                            </div>
                            @endif  
                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{isset($categoryProperty)? route('categoryProperty.update',$categoryProperty->id):route('categoryProperty.store')}}">
                                @csrf
                                @if (isset($categoryProperty))
                                {{ method_field('PUT') }}
                                @endif
                                <label class="form-label" for="">Property Name </label>
                                <input type="text" value="{{$categoryProperty->property_name??""}}" class="form-control @error('property_name') is-invalid @enderror" name="property_name">
                                @error('property_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="cat_id" value="{{$category->id}}">
                                <button class="mt-1 btn btn-primary mt-2">{{isset($categoryProperty)?'Update':'Save'}}</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

</div>

@endsection