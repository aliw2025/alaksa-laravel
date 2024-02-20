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
                      <a  style="color: black" href="{{route('create-user-accounts')}}">My Accounts</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('show-upcoming-instalments')}}"> Upcomiing Instalments</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('user-transfer-balances')}}">Funds Transfer</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="#"> Recieve Installment</a> 
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('get-user-acc-balances')}}">  Account Balances</a> 
                       
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('ro-transfer-queue')}}">  Pending Transfer Request</a> 
                    </div>
                    
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <a  style="color: black" href="{{route('instalment-payment-report')}}">Payment Reports</a> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
