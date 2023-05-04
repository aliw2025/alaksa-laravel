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
                                <h4 class="text-center">permissions</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Role Name</th>

                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @If(isset($permissions))
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach($permissions as $p)
                                    <tr>
                                        <td>
                                            {{$count}}
                                        </td>
                                        <td>
                                            {{$p->name}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <form class="" method="POST" autocomplete="on" action="{{ route('delete-permission', $p->id) }}">
                                                    @csrf

                                                    <button style="border:0ch;background-color:white !important;" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class="" method="GET" autocomplete="on" action="{{ route('edit-permission', $p->id) }}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <button style="border:0ch;background-color:white !important;" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    @php
                                    $count+= 1;
                                    @endphp
                                    @endforeach
                                    @endif
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
                                    <h4 class="text-center"> {{ isset($permission)?'Update permission':'add new permission'}} </h4>

                                </div>
                            </div>
                            <div>
                                @if(isset($permission ))
                                <a href="route{{('permission    s')}}">add new</a>
                                @endif
                            </div>
                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{ isset($permission)? route('update-permission',$permission->id):route('store-permission')}}">
                                @csrf
                                <label class="form-label" for="">permission Name </label>
                                <input @if(isset($permission)) value="{{$permission->name}}" @endif type="text" name="name" class="form-control @error('account_name') is-invalid @enderror">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                @if(isset($permission))
                                <button class="btn btn-primary mt-2">Update</button>
                                @else
                                <button class="btn btn-primary mt-2">save</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection