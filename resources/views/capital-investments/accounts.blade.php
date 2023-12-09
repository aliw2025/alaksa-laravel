@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="">

        <div class="">
            <div class="row">
                <div class="col-9 ">
                    <div class="card">
                        <div class="card-header d-flex ">
                            <div>
                                <h4 class="text-center">Investor Bank Accounts</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Account Title</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                    $count = 1
                                    @endphp
                                    @foreach($accounts as $ac)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$ac->bank_name??""}}</td>
                                        <td>{{$ac->account_name}}</td>
                                        <td>{{$ac->account_number}}</td>
                                        <td class="d-flex">
                                            <a style="text-decoration: none;color:black" href="{{route('chartOfAccount.edit', $ac->id)}}"><i data-feather='edit'></i></a>
                                            <form method="POST" action="{{ route('chartOfAccount.destroy', $ac->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background-color: transparent;">
                                                    <i data-feather='trash-2'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                    $count = $count+1
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-3 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex justify-content-center">
                                <div>
                                    <h4 class="text-center">{{isset($chartOfAccount)?'Update Account':'Add New Account'}}</h4>
                                </div>
                            </div>
                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{isset($chartOfAccount)?route('chartOfAccount.update',$chartOfAccount->id):route('chartOfAccount.store')}}">
                                @csrf

                                @if (isset($chartOfAccount))
                                {{ method_field('PUT') }}
                                @endif
                                <label class="form-label" for="">Bank Name </label>
                                <input @if(isset($chartOfAccount)) value="{{$chartOfAccount->bank_name}}" @endif type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror">
                                @error('bank_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label class="form-label" for="">Account Title </label>
                                <input type="text"  @if(isset($chartOfAccount)) value="{{$chartOfAccount->account_name}}" @endif name="account_name" class="form-control @error('account_name') is-invalid @enderror">
                                @error('account_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label class="form-label mt-1" for="">Account Number </label>
                                <input  @if(isset($chartOfAccount)) value="{{$chartOfAccount->account_number}}" @endif type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number">
                                @error('account_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button class="btn btn-primary mt-2">{{isset($chartOfAccount)?'Update':'Save'}}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Session::has('message'))

<script>
    $(document).ready(function() {
        toastr.success("{{Session::get('message')}}", "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: false
        });
    });
</script>
@endif
@if(Session::has('error'))
<script>
    $(document).ready(function() {
        toastr.error("{{ Session::get('error') }}", "Failed!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    });
</script>
@endif
@endsection