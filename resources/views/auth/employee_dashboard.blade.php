@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Waseem Ali</div>
                    </div>
                </div>
            </div>
        </div> --}}
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <a style="color: black" href="{{route('edit-designation',$user->id)}}">change designation</a>
                </div>

            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <a style="color: black" href="{{route('admin-password-change.create',$user->id)}}"> change password </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection