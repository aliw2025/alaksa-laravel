@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Change Designation</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="" method="POST" action="{{route('change-designation')}}">
                        @csrf
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <label class="form-label" for="">Name</label>
                                <input type="text" class="form-control" value="{{$user->name}}">
                                <input name="user_id" type="hidden" value="{{$user->id}}">        
                                <label class="form-label" for="">Designation</label>
                                <select  name="designation_id" class="form-select" id="">
                                    @foreach($designations as $des)
                                    <option @if($user->designaion!=NULL) @if($des->id!=$user->designation->id) selected @endif @endif value="{{$des->id}}">{{$des->Name}}</option>
                                    @endforeach
                                </select>
                                <div class="d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </form>
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