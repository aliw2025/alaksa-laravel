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
            <div class="container">
                <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('investor.store')}}">

                        @csrf
                    <div class="row w-50 mx-auto">
                        <div class=" ">
                            <!-- <input id="investorName" name="investor_name" class="@error('investor_name') is-invalid @enderror form-control" autocomplete="off" id="exampleDataList" placeholder="Enter investor Name"> -->
                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">investor Name</label>
                                <input type="text" id="investorName" class=" @error('investor_name') is-invalid @enderror form-control" name="investor_name" placeholder="investor Name">
                                @error('investor_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-1">
                                <label class="form-label" for="email-id-vertical">Email</label>
                                <input type="email" id="email" class="@error('email') is-invalid @enderror form-control" name="email" placeholder="Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-1">
                                <label class="form-label" for="contact-info-vertical">Mobile</label>
                                <input type="number" id="contact-info-vertical" class="@error('phone') is-invalid @enderror form-control" name="phone" placeholder="Mobile">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-1">
                                <label class="form-label" for="exampleFormControlTextarea1">Address</label>
                                <textarea name="address" class="@error('address') is-invalid @enderror form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Address"></textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
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