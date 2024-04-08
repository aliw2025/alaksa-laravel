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
                                <h4 class="text-center">Expense Heads</h4>
                              
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important"*>#</th>
                                        <th scope="col">name</th>
                                       
                                        <th scope="col">Action</th>
                                        <th>Active</th>

                                    </tr>
                                </thead>
                                <tbody class="inventory-iems-body" id="nventory-iems-body">
                                    @php
                                    $count = 1
                                    @endphp
                                    @foreach($heads as $head)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$head->name}}</td>
                                        <td class="d-flex">
                                            <a style="text-decoration: none;color:black" href="{{route('add-sub-exp-head',$head->id)}}">sub heads</a>
                                            <a class="ms-2" style="text-decoration: none;color:black" href="{{route('expenseHead.edit',$head->id)}}"><i data-feather='edit'></i></a>
                                           
                                            <form method="POST" action="{{route('expenseHead.destroy',$head->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background-color: transparent;">
                                                    <i data-feather='trash-2'></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>@if(isset($head)) {{$head->active}} @endif</td>
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
                                 <h4 class="text-center">{{ isset($expenseHead) ? 'Update expense head' : 'Add New expense head' }}</h4>

                                </div>
                            </div>
                            @if (isset($expenseHead))
                            <div class="d-flex justify-content-end">
                                <div>
                                    <a href="{{ route('expenseHead.index') }}" type=" reset" class="">
                                        Add New
                                    </a>
                                </div>
                            </div>
                            @endif
                            <form method="POST" class="form form-vertical" autocomplete="on" action=" {{ isset($expenseHead) ? route('expenseHead.update', $expenseHead) : route('expenseHead.store') }}">
                                @csrf
                                @if (isset($expenseHead))
                                {{ method_field('PUT') }}
                                @endif
                                <label class="form-label" for="">Name </label>

                                <input value="{{ old('head_name', isset($expenseHead) ? $expenseHead->name : '') }}" type="text" class="@error('head_name') is-invalid @enderror form-control" name="head_name">
                                @error('head_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label class="mt-2 form-label" for="">Active </label>
                                <select class=" form-control" name="active" id="active_id">
                                    
                                    <option @if(isset($expenseHead)) @if($expenseHead->active==1) selected @endif @endif value="1">y</option>
                                    <option @if(isset($expenseHead)) @if($expenseHead->active==0) selected @endif @endif value="0">n</option>
                                </select>
                                <button type="submit" class="mt-2 btn btn-primary me-1 waves-effect waves-float waves-light">{{ isset($expenseHead) ? 'Update' : 'Add' }}</button>

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