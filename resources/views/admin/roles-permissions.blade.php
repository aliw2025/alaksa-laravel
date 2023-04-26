@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="">
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex ">
                            <div>
                                <h4 class="text-center">Assign Permission to roles</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 ">
                    <div class="card">
                        <div class="card-header d-flex ">
                            <div>
                                <h4 class="text-center">Roles</h4>
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
                                    @If(isset($roles))
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            {{$count}}
                                        </td>
                                        <td>
                                            <!-- <a href="">{{$role->name}}</a> -->
                                            {{$role->name}}
                                        </td>
                                        <td>
                                            <!-- onclick="roleSelected()" -->
                                            <a data-role='{{$role->name}}' class="role" href="#">select</a>
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
                <div class="col-6 ">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h4 class="text-center">Add Permission</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('role-permissions')}}">
                                    <div class="col-6">
                                        <input type="hidden" name="role_id" class="form-control">

                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control" name="permission" id="">
                                            @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">

                                        <button class="mt-2  btn btn-primary">ADd</button>
                                    </div>
                                </form>

                            </div>


                            <div class="mt-2">
                                <table id="investor-table" class="table">
                                    <thead class="thead-dark">
                                        <tr style="background-color:red !important;">
                                            <th style="width: 2px !important">#</th>
                                            <th scope="col">Role Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="inventory-iems-body" id="nventory-iems-body">
                                        @If(isset($roles))
                                        @php
                                        $count = 1;
                                        @endphp
                                        @foreach($roles as $role)
                                        <tr>
                                            <td>
                                                {{$count}}
                                            </td>
                                            <td>
                                                <!-- <a href="">{{$role->name}}</a> -->
                                                {{$role->name}}
                                            </td>
                                            <td>
                                                <!-- onclick="roleSelected()" -->
                                                <a data-role='{{$role->name}}' class="role" href="#">select</a>
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.role').on('click', function() {
        // console.log('waseem');
        console.log(this);
    });


    function roleSelected() {

        console.log('role selected');

    }
</script>
@endsection