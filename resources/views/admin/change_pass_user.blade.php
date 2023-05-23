@extends('template.header')
@section('section')

<div class="card">
    <div class="card-header">
        <h4>Change Password</h4>
    </div>
    <div class="card-body">

        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <form method="POST" action="{{ route('user-password-change') }}">
                    @csrf

                    <div>
                        <label for="current_password">Current Password</label>
                        <input class="form-control" type="password" name="current_password" required>
                    </div>

                    <div class="mt-1">
                        <label for="password">New Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>

                    <div class="mt-1">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>

                    <button class="mt-2 btn btn-primary" type="submit">Change Password</button>
                </form>
            </div>
        </div>

    </div>
</div>
<script>
    var rowId = 0;
    $(document).ready(function() {

        
        @if(isset($message))
            console.log('here');
            toastr.success(
                "{{$message}}",
                "Success!", {
                    closeButton: !0,
                    tapToDismiss: !1,
                    rtl: false
                }
            );
            @endif
       

    });
</script>
@endsection