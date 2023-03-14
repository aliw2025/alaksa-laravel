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
                                    <h4 class="text-center">Funds Transfer Approvals </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                @foreach ($tr as $t)
                                    <div>
                                        
                                        {{$t->amount}}
                                    
                                    </div>    
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
