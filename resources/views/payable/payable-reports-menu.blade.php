@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
      
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                      <a  style="color: black" href="{{ route('get-payables')}}">Supplier payable Reports</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{ route('show-supplier-payments') }}">Supplier Payment Reports</a> 
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="#">Expense Payable Reports</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
