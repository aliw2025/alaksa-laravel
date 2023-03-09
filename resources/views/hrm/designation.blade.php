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
                                        <th scope="col">designation name</th>
                                        <th scope="col">PayScale Pay</th>
                                        <th scope="col">Action</th>

                                        
                                    </tr>
                                </thead>
                                <tbody class="set-iems-body" id="set-iems-body">
                                    @php
                                    $count = 1;
                                    @endphp
                                    @if(isset($designations))
                                    @foreach ($designations as $inv)
                                    <tr>
                                        <th style="width: 2px !important">{{$count}}</th>
                                        <td>{{ $inv->Name }}</td>
                                        <td>{{ $inv->pay_Scale->scale_name }}</td>
                                      
                                        <td>
                                            <div class="d-flex align-items-center">

                                                {{-- <form class="" method="POST" autocomplete="on" action="#">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{$inv->id}}" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form> --}}
                                                <form class="" method="GET  " autocomplete="on" action="#">
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
                        <h4 class="text-center">{{isset($scale)? "Update Scale":'Add New Pay Scale'}}</h4>
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
                        <form method="POST" class="form form-vertical" autocomplete="on" action=" {{isset($desingation)? route('designation.update',$scale) :route('designation.store')}}">
                            @csrf
                            <div class="row ">
                                
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Designation Name</label>
                                        <input value="{{old('designation_name',isset($scale)? $scale->scale_name  :'')}}" type="text" id="investorName" class=" @error('designation_name') is-invalid @enderror form-control" name="designation_name" placeholder="designation Name">
                                        @error('designation_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" ">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Scale Pay</label>
                                        <select class="form-select" name="pay_scale" id="">
                                            @foreach($scales as $sc)
                                            <option value="{{$sc->id}}"> {{$sc->scale_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('pay_scale')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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