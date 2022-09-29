@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="card">
        <div class="card-header d-flex justify-content-center">
            <div>
                <h4 class="text-center">Add New Investor</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <!-- <div>
                    <a href='{{route("investor.index")}}'" type=" reset" class="">
                        View All
                    </a>
                </div> -->
            </div>
            <div class="container">
                <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('investor.store')}}">

                    @csrf
                    <div class="row w-50 mx-auto">
                        <div class=" ">
                            {{$investossdsr->investor_name}}
                            <!-- <input id="investorName" name="investor_name" class="@error('investor_name') is-invalid @enderror form-control" autocomplete="off" id="exampleDataList" placeholder="Enter investor Name"> -->
                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">Investor Name</label>
                                <input type="text" id="investorName" class=" @error('investor_name') is-invalid @enderror form-control" name="investor_name" placeholder="investor Name">
                                @error('investor_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <div class="mb-1">
                                <label class="form-label" for="email-id-vertical">Email</label>
                                <input value="{{old('email')}}"  type="email" id="email" class="@error('email') is-invalid @enderror form-control" name="email" placeholder="Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-1">
                                {{-- @if(isset($investor)) --}}
                                
                                {{-- @endif --}}
                                <label class="form-label" for="contact-info-vertical">Mobile</label>
                                <input  value="{{old('phone')}}" type="number" id="contact-info-vertical" class="@error('phone') is-invalid @enderror form-control" name="phone" placeholder="Mobile">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class=" ">
                            <!-- <input id="investorName" name="investor_name" class="@error('investor_name') is-invalid @enderror form-control" autocomplete="off" id="exampleDataList" placeholder="Enter investor Name"> -->
                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">Investor Short Name</label>
                                <input type="text" id="prefix" class=" @error('prefix') is-invalid @enderror form-control" name="prefix" placeholder="Short Name">
                                @error('prefix')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class=" ">
                            <!-- <input id="investorName" name="investor_name" class="@error('investor_name') is-invalid @enderror form-control" autocomplete="off" id="exampleDataList" placeholder="Enter investor Name"> -->
                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">Opening Balance</label>
                                <input type="number" id="opening_balance" class=" @error('prefix') is-invalid @enderror form-control" name="opening_balance" placeholder="Short Name">
                                @error('opening_balance')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="">
                            <div class="mb-1">
                                <label class="form-label" for="exampleFormControlTextarea1">Address</label>
                                <textarea name="address" class="@error('address') is-invalid @enderror form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Address"></textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> -->
                        <div class="">
                            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Add</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).ready(function() {
            $('#items-table').DataTable();
        });

    });
</script>
@endsection