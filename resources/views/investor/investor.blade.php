@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Investors</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <div class="d-flex justify-content-end">
                        <div>
                            <button onclick="window.location='{{route("investor.create")}}'" href="http://localhost/cssd/quotations/create" type="reset" class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                Add New
                            </button>
                        </div>
                    </div> -->
                    <div class="row ">
                        <div class="col-12 ">
                            <table id="items-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th>#</th>
                                        <th scope="col">investor name</th>
                                        <th scope="col">Short name</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="set-iems-body" id="set-iems-body">
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($investors as $investor)
                                    <tr>
                                        <th>{{$count}}</th>
                                        <td>{{ $investor->investor_name }}</td>
                                        <td>{{ $investor->prefix }}</td>
                                        <td>{{ $investor->created_at }}</td>
                                        <td class="d-flex">
                                            <form class="" method="POST" autocomplete="on" action="{{ route('investor.destroy',$investor->id)}}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button style="border:0ch;background-color:white !important;" id="btnDel{{$investor->id}}" type="submit" class=""><i data-feather='trash-2'></i></button>
                                            </form>
                                            <form class="" method="POST" autocomplete="on" action="{{ route('investor.update',$investor->id)}}">
                                                @csrf
                                                {{ method_field('UPDATE') }}
                                                <button style="border:0ch;background-color:white !important;" id="btnDel{{$investor->id}}" type="submit" class=""><i data-feather='edit'></i></button>
                                            </form>

                                        </td>
                                        @php
                                        $count = $count+1;
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <div>
                        <h4 class="text-center">Add New Investor</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <div class="d-flex">
                        <div>
                            <a href='{{route("investor.index")}}'" type=" reset" class="">
                                View All
                            </a>
                        </div>
                    </div> -->
                    <div class="">
                        <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('investor.store')}}">
                            @csrf
                            <div class="row ">
                                <div class=" ">
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