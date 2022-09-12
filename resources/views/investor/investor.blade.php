@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="card ">
        <div class="card-header">
            <div class="card-title">
                <h4>Add Investor</h4>
            </div>
        </div>
        <!-- <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form method="POST" autocomplete="on" action="{{ route('investor.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <input id="investorName" name="investor_name" class="@error('investor_name') is-invalid @enderror form-control" autocomplete="off" id="exampleDataList" placeholder="Enter investor Name">
                                @error('investor_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <button id="btnSave" type="submit" class="btn btn-primary"><i data-feather='plus'></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4 class="my-1">investors</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div>
                    <button onclick="window.location='{{route("investor.create")}}'" href="http://localhost/cssd/quotations/create" type="reset" class="btn btn-primary me-1 waves-effect waves-float waves-light">
                        Add New
                    </button>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12 ">
                    <table id="items-table" class="table">
                        <thead class="thead-dark">
                            <tr style="background-color:red !important;">
                                <th>#</th>
                                <th scope="col">investor name</th>
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
                                <td class="d-flex justify-content-spacearoud">
                                    <form method="POST" autocomplete="on" action="{{ route('investor.destroy',$investor->id)}}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button style="" id="btnDel{{$investor->id}}" type="submit" class="btn btn-secondary">Delete</button>
                                    </form>
                                    <button onclick="window.location='{{route("investor.edit",$investor->id)}}' href="http://localhost/cssd/quotations/create" type="reset" class="btn btn-info me-1 waves-effect waves-float waves-light">
                                        edit
                                    </button>

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
<script type="text/javascript">
    $(document).ready(function() {

        $(document).ready(function() {
            $('#items-table').DataTable();
        });

    });
</script>
@endsection