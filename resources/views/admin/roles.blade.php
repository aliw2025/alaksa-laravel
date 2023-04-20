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
                                        <h4 class="text-center">Add New Role</h4>
                                    </div>
                                </div>
                                <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('store-user-accounts')}}">
                                    @csrf
                                    <label class="form-label" for="">Role Name </label>
                                    <input type="text"  name="account_name"  class="form-control @error('account_name') is-invalid @enderror" >
                                    @error('role_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  
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
