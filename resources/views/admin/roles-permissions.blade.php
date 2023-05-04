@extends('template.header')
@section('section')
<style>
    .highlight { background-color: #F3F2F7; }

</style>

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
                            <div class="card-body">
                                <div class="row">
                                    <form method="POST" class="form form-vertical" autocomplete="on"
                                        action="{{ route('role-permissions') }}">
                                        {{-- <div class="col-6">
                                           
                                            <input value="1" type="hidden" name="role_id" class="form-control">

                                        </div> --}}
                                        <div class="col-3">
                                            @csrf
                                            <select class="form-control" name="role" id="">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            <select class="mt-2 form-control" name="permission" id="">
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">

                                            <button class="mt-2  btn btn-primary">ADd</button>
                                        </div>
                                    </form>

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
                                <table id="data" class="table">
                                    <thead class="thead-dark">
                                        <tr style="background-color:red !important;">
                                            <th style="width: 2px !important">#</th>
                                            <th scope="col">Role Name</th>
                                            {{-- <th scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="inventory-iems-body" id="nventory-iems-body">
                                        @if (isset($roles))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($roles as $role)
                                                <tr id="{{$role->id}}">
                                                    <td>
                                                        {{ $count }}
                                                    </td>
                                                    <td>
                                                        <!-- <a href="">{{ $role->name }}</a> -->
                                                        {{ $role->name }}
                                                    </td>
                                                    

                                                </tr>
                                                @php
                                                    $count += 1;
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
                                    <h4 class="text-center">Permission</h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="mt-2">
                                    <table id="investor-table" class="table">
                                        <thead class="thead-dark">
                                            <tr style="background-color:red !important;">
                                                <th style="width: 2px !important">#</th>
                                                <th scope="col">Role Name</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="inventory-iems-body" id="role-permissions">
                                            
                                         
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

        $("#data tr").click(function() {
            var selected = $(this).hasClass("highlight");
            $("#data tr").removeClass("highlight");
            if (!selected)
                $(this).addClass("highlight");
            
            var roleId =$(this).attr('id');
            $('#role_id').val(roleId);
            
            $.ajax({
                url: "{{ route('get-role-permissions') }}",
                type: "GET",
                data: {
                    id: roleId,
                    
                },
                success: function(dataResult) {
                    $("#role-permissions").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i];
                        var count = i+1;
                        console.log(item);
                        markup = `<tr >
                                        <td>
                                          `+count+`
                                        </td>
                                        <td>
                                            `+item.name+`
                                        </td>
                                        <td>
                                            <div class="">
                                                <form class="" method="POST" autocomplete="on"
                                                    action="{{route('unassign-role-permissions')}}">
                                                    @csrf
                                                    <input name="role_id" type="hidden" value="`+ roleId+`">
                                                    <input name="permission_id" type="hidden" value="`+item.id +`">
                                                    <button
                                                       
                                                         type="submit"
                                                        class="btn btn-danger">Remove</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>`
                        $("#role-permissions").append(markup);
                    }
                },
                error: function(xhr, status, error) {

                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err);
                },
            });
        });


    </script>
@endsection
