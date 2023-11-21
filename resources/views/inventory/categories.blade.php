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
                                            <div class="d-flex">
                                                <a style="text-decoration: none;color:black" href="{{route('create-property',$cat->id)}}">Properties</a>
                                                <a class="ms-2" style="text-decoration: none;color:black" href="{{route('category.edit',$cat->id)}}"> <i data-feather='edit'></i></a>
                                                <form method="POST" action="{{ route('category.destroy', $cat->id) }}">
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
                                    <h4 class="text-center">{{isset($category)? 'Update Category':'Add New Category'}}</h4>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('category.create')}}">add new</a>
                            </div>
                            <form method="POST" class="form form-vertical" autocomplete="on"  action="{{isset($category)? route('category.update',$category) :route('category.store')}}">
                                @csrf
                                @if (isset($category))
                                        {{ method_field('PUT') }}
                                    @endif
                                <label class="form-label" for="">Category Name </label>
                                <input @if(isset($category)) value="{{$category->category_name}}"  @endif type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name">
                                @error('category_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if(isset($category))
                                    <button class="mt-1 btn btn-primary mt-2">Update</button>
                                @else
                                    <button class="mt-1 btn btn-primary mt-2">save</button>
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

</div>

 
@if(Session::has('message'))

<script>
    $(document).ready(function() {
        toastr.success("{{Session::get('message')}}", "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: false
        }); 
    });
</script>
@endif
@if(Session::has('error'))
<script>
    $(document).ready(function() {
        toastr.error("{{ Session::get('error') }}", "Failed!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    });
</script>
@endif 

@endsection