@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="">Users</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">name</th>
                                        <th scope="col">email</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                        $count = 1
                                    @endphp
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->designation->Name}}</td>
                                        <td>
                                            <a style="text-decoration: none;color:black" href="{{route('edit-designation',$user->id)}}"><i data-feather='edit'></i></a>
             
                                        </td>
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
        </div>
    </div>

    <script src="{{ url('/resources/js/scripts/pages/app-invoice.min.js') }}"></script>
    <script type="text/javascript">
      
    </script>
@endsection
