@extends('template.header')
@section('section')
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="dashboard-ecommerce">

                <div class=" card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 1 sec ago</p>
                        </div>
                    </div>
                    @if(isset($investor))
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card p-2 p-2 me-2 ">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($sale)}}</h4>
                                        <p class="card-text font-small-3 mb-0">Sales</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card  p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg> --}}
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($investor_bank)}}</h4>
                                        <p class="card-text font-small-3 mb-0">{{$investor->prefix}} Bank balance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card  p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg> --}}
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($investor_cash)}}</h4>
                                        <p class="card-text font-small-3 mb-0">{{$investor->prefix}} cash in hand</p>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card mt-1 p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg> --}}
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($total_balance_investor)}}</h4>
                                        <p class="card-text font-small-3 mb-0">{{$investor->prefix}} total Balance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0  mt-1 card p-2 me-2 ">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($rcv_cash)}}</h4>
                                        <p class="card-text font-small-3 mb-0">Recievables</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 mt-1 card p-2 me-2 ">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$payables}}</h4>
                                        <p class="card-text font-small-3 mb-0">Payables</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 mt-1 card p-2 me-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($expenses)}}</h4>
                                        <p class="card-text font-small-3 mb-0">Expenses</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 mt-1 card p-2 me-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($asset)}}</h4>
                                        <p class="card-text font-small-3 mb-0">Assets</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 mt-1 card p-2 me-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up avatar-icon">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($pft)}}</h4>
                                        <p class="card-text font-small-3 mb-0">Unrealized Profit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 mt-1 card p-2 me-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">                                           
                                            <i data-feather='heart'></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">0</h4>
                                        <p class="card-text font-small-3 mb-0">Charity</p>
                                    </div>
                                </div>
                            </div>
                            @if($investor->id==1)
                            <hr class="mt-1">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card mt-1 p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($total_bank)}}</h4>
                                        <p class="card-text font-small-3 mb-0">total Bank Balance </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card mt-1 p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg> --}}
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($total_cash)}}</h4>
                                        <p class="card-text font-small-3 mb-0">total cash in hand</p>
                                    </div>
                                </div>
                            </div>
                            
                           
                            
                            @endif
                            
                            @if($investor->id==1)
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card mt-1 p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg> --}}
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($others_total)}}</h4>
                                        <p class="card-text font-small-3 mb-0">investor's net Total</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0 card card mt-1 p-2 me-2 p-2">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg> --}}
                                            <i class="fa fa-money" style="font-size:28px;color:red"></i>

                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{number_format($total_balance)}}</h4>
                                        <p class="card-text font-small-3 mb-0">Net Available Cash</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                           
                            
                        </div>
                    </div>
                    @endif
                </div>
            </section>

        </div>
    </div>
@endsection
