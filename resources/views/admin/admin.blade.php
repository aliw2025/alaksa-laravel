@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Waseem Ali</div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                      <a  style="color: black" href="{{route('roles')}}">Define Roles</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('permissions')}}"> Define Permission</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('roles-permissions')}}">Assgin permission to Roles</a> 
                    </div>
                    
                </div>
            </div>
          
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('user-roles')}}">Assgin Roles to users</a> 
                    </div>
                    
                </div>
            </div>
            
            <!-- <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('register')}}">Register</a> 
                    </div>
                    
                </div>
            </div> -->
        
        </div>
    </div>
@endsection
