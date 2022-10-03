@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Investors</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">
                        <div class="col-12 table-responsive">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">investor name</th>
                                        <th scope="col">Short name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="set-iems-body" id="set-iems-body">
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($investors as $inv)
                                    <tr>
                                        <th style="width: 2px !important">{{$count}}</th>
                                        <td>{{ $inv->investor_name }}</td>
                                        <td>{{ $inv->prefix }}</td>
                                        <td>{{ $inv->email }}</td>
                                        <td>{{ $inv->phone }}</td>
                                        <td>{{ $inv->created_at }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <form class="" method="POST" autocomplete="on" action="{{ route('investor.destroy',$inv->id)}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{$inv->id}}" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class="" method="GET  " autocomplete="on" action="{{ route('investor.edit',$inv->id)}}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{$inv->id}}" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                            </div>
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
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <div>
                        <h4 class="text-center">{{isset($investor)? "Update Investor":'Add New Investor'}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($investor))
                    <div class="d-flex justify-content-end">
                        <div>
                            <a href='{{route("investor.index")}}'" type=" reset" class="">
                                Add New
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="">
                        <form method="POST" class="form form-vertical" autocomplete="on" action=" {{isset($investor)? route('investor.update',$investor) :route('investor.store')}}">
                            @csrf
                            <div class="row ">
                                
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Investor Name</label>
                                        <input value="{{old('investor_name',isset($investor)? $investor->investor_name  :'')}}" type="text" id="investorName" class=" @error('investor_name') is-invalid @enderror form-control" name="investor_name" placeholder="investor Name">
                                        @error('investor_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input value="{{old('investor_type',isset($investor)? $investor->type:'2')}}" type="hidden" id="investor_type" class="@error('investor_type') is-invalid @enderror form-control" name="investor_type" placeholder="Email">

                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-vertical">Email</label>
                                        <input value="{{old('email',isset($investor)? $investor->email:'')}}" type="email" id="email" class="@error('email') is-invalid @enderror form-control" name="email" placeholder="Email">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Mobile</label>
                                        <input value="{{old('phone',isset($investor)? $investor->phone:'')}}" type="number" id="contact-info-vertical" class="@error('phone') is-invalid @enderror form-control" name="phone" placeholder="Mobile">
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Investor Short Name</label>
                                        <input value="{{old('prefix',isset($investor)? $investor->prefix:'')}}" type="text" id="prefix" class=" @error('prefix') is-invalid @enderror form-control" name="prefix" placeholder="Short Name">
                                        @error('prefix')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @if (!isset($investor))
                                <div class=" ">
                                    <!-- <input id="investorName" name="investor_name" class="@error('investor_name') is-invalid @enderror form-control" autocomplete="off" id="exampleDataList" placeholder="Enter investor Name"> -->
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Opening Balances</label>
                                        <input type="number" id="opening_balance" class=" @error('prefix') is-invalid @enderror form-control" name="opening_balance" value="0" placeholder="Opening Balance">
                                        @error('opening_balance')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                @endif
                               

                                <div class="">
                                    @if (isset($investor))
                                    {{ method_field('PUT') }}
                                    @endif

                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{isset($investor)? 'Update': 'Add'}}</button>
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
            $('#investor-table').DataTable();
        });

    });
</script>
@endsection