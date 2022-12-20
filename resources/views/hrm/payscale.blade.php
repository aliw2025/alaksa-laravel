@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Pay Scales</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">
                        <div class="col-12 table-responsive">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">PayScale name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="set-iems-body" id="set-iems-body">
                                    @php
                                    $count = 1;
                                    @endphp
                                    @if(isset($designations))
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
                                    @endif
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
                        <h4 class="text-center">{{isset($Designation)? "Update Investor":'Add New Designation'}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($investor))
                    <div class="d-flex justify-content-end">
                        {{-- <div>
                            <a href='{{route("investor.index")}}'" type=" reset" class="">
                                Add New
                            </a>
                        </div> --}}
                    </div>
                    @endif
                    <div class="">
                        <form method="POST" class="form form-vertical" autocomplete="on" action=" {{isset($investor)? route('investor.update',$investor) :route('investor.store')}}">
                            @csrf
                            <div class="row ">
                                
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Designation Name</label>
                                        <input value="{{old('investor_name',isset($investor)? $investor->investor_name  :'')}}" type="text" id="investorName" class=" @error('investor_name') is-invalid @enderror form-control" name="investor_name" placeholder="Designation Name">
                                        @error('investor_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Pay Scale</label>
                                        <select class="form-select" name="" id="">
                                            <option value="1"> 12</option>
                                        </select>
                                    </div>
                                </div>

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