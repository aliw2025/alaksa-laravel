@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="">
        
        <div class="">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                    <div class="card-header d-flex ">
                        <div>
                            <h4 class="text-center">Account Balances </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="investor-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th style="width: 2px !important">#</th>
                                    <th scope="col">name</th>
                                    <th>balance</th>
                                    <th>investor</th>
                                   
                                    <!-- <th scope="col">email</th>
                                    <th scope="col">Designation</th> -->
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody class="inventory-iems-body" id="nventory-iems-body">
                                @php
                                $count = 1
                                @endphp
                                @foreach($transactions as $tran)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$tran->investor->investor_name}}</td>
                                    <td>{{$tran->account->account_name}}</td>
                                    <td>{{$tran->value}}</td>
                                    <td>
                                        <a style="text-decoration: none;color:black" href="#"><i data-feather='edit'></i></a>
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
    </div>
</div>
@endsection