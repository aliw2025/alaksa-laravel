@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Customers</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">
                        <div class="col-12 table-responsive">
                            <table id="customer-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">customer name</th> 
                                        <th scope="col">CNIC</th>
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
                                    @foreach ($customers as $inv)
                                    <tr>
                                        <th style="width: 2px !important">{{$count}}</th>
                                        <td>{{ $inv->customer_name }}</td>
                                        <td>{{ $inv->CNIC }}</td>
                                        <td>{{ $inv->email }}</td>
                                        <td>{{ $inv->phone }}</td>
                                        <td>{{ $inv->created_at }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <form class="" method="POST" autocomplete="on" action="{{ route('customer.destroy',$inv->id)}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{$inv->id}}" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class="" method="GET  " autocomplete="on" action="{{ route('customer.edit',$inv->id)}}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{$inv->id}}" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                                <a style="color: black" href="{{route('customer-files',$inv->id)}}"><i data-feather="file"></i></a>
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
                        <h4 class="text-center">{{isset($customer)? "Update customer":'Add New customer'}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($customer))
                    <div class="d-flex justify-content-end">
                        <div>
                            <a href='{{route("customer.index")}}'" type=" reset" class="">
                                Add New
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="">
                        <form method="POST" class="form form-vertical" autocomplete="on" action=" {{isset($customer)? route('customer.update',$customer) :route('customer.store')}}">
                            @csrf
                            <div class="row">
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Customer UUID</label>
                                        <input disabled type="text" id="customerUUID" class="form-control" name="customer_uuid" placeholder="customer UUID">
                                       
                                    </div>
                                </div>
    
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">customer Name</label>
                                        <input value="{{old('customer_name',isset($customer)? $customer->customer_name  :'')}}" type="text" id="customerName" class=" @error('customer_name') is-invalid @enderror form-control" name="customer_name" placeholder="customer Name">
                                        @error('customer_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input value="{{old('customer_type',isset($customer)? $customer->type:'2')}}" type="hidden" id="customer_type" class="@error('customer_type') is-invalid @enderror form-control" name="customer_type" placeholder="Email">

                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-vertical">Email</label>
                                        <input value="{{old('email',isset($customer)? $customer->email:'')}}" type="email" id="email" class="@error('email') is-invalid @enderror form-control" name="email" placeholder="Email">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Mobile</label>
                                        <input value="{{old('phone',isset($customer)? $customer->phone:'')}}" type="number" id="contact-info-vertical" class="@error('phone') is-invalid @enderror form-control" name="phone" placeholder="Mobile">
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">CNIC</label>
                                        <input value="{{old('CNIC',isset($customer)? $customer->CNIC:'')}}" type="number" id="contact-info-vertical" class="@error('CNIC') is-invalid @enderror form-control" name="CNIC" placeholder="CNIC">
                                        @error('CNIC')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Customer Address</label>
                                        <textarea value="" type="text" id="customerAddress" class=" @error('address') is-invalid @enderror form-control" name="address" placeholder="customer Address">{{old('address',isset($customer)? $customer->address  :'')}} </textarea>
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Garentier1 Name</label>
                                        <input value="{{old('g1_name',isset($customer)? $customer->g1_name:'')}}" type="text" id="contact-info-vertical" class="@error('g1_name') is-invalid @enderror form-control" name="g1_name" placeholder="Garantier Name">
                                        @error('g1_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Garentier1 CNIC</label>
                                        <input value="{{old('g1_CNIC',isset($customer)? $customer->g1_CNIC:'')}}" type="text" id="contact-info-vertical" class="@error('g1_CNIC') is-invalid @enderror form-control" name="g1_CNIC" placeholder="Garentier CNIC">
                                        @error('g1_CNIC')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Garentier1 Address</label>
                                        <textarea value="" type="text" id="gAddress" class=" @error('g1_address') is-invalid @enderror form-control" name="g1_address" placeholder="Garentier Address">{{old('g1_address',isset($customer)? $customer->g1_address  :'')}}</textarea>
                                        @error('g1_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- 2nd garentier --}}
                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Garentier2 Name</label>
                                        <input value="{{old('g2_name',isset($customer)? $customer->g2_name:'')}}" type="text" id="contact-info-vertical" class="@error('g2_name') is-invalid @enderror form-control" name="g2_name" placeholder="Garantier Name">
                                        @error('g2_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Garentier2 CNIC</label>
                                        <input value="{{old('g2_CNIC',isset($customer)? $customer->g2_CNIC:'')}}" type="text" id="contact-info-vertical" class="@error('g2_CNIC') is-invalid @enderror form-control" name="g2_CNIC" placeholder="Garentier CNIC">
                                        @error('g2_CNIC')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Garentier2 Address</label>
                                        <textarea value="" type="text" id="gAddress" class=" @error('g2_address') is-invalid @enderror form-control" name="g2_address" placeholder="Garentier Address">{{old('g2_address',isset($customer)? $customer->g2_address  :'')}}</textarea>
                                        @error('g2_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">note</label>
                                        <textarea value="" type="text" id="gAddress" class=" @error('note') is-invalid @enderror form-control" name="note" placeholder="Garentier Address">{{old('note',isset($customer)? $customer->note:'')}}</textarea>
                                        @error('note')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="">
                                    @if (isset($customer))
                                    {{ method_field('PUT') }}
                                    @endif

                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{isset($customer)? 'Update': 'Add'}}</button>
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
            $('#customer-table').DataTable();
        });

    });
</script>
@endsection