@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
<x-admin.layouts.adminnavbar modulename="BRANCH" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('settings') }}">Settings</a>
    </li>

    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
</x-admin.layouts.adminbreadcrumb>



<div class="card shadow-sm">
    <div class="card-header text-white bg-success">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight"><span class="h4">CHANGE PASSWORD</span></div>
        </div>
    </div>

    <!--Card-->
    <div class="card-body mx-auto">
    <div class="card p-3" style="width: 500px;">
        <form method="POST" action="{{ route('changepassword') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="mb-3" x-data="{ show: true }">
                <label for="Input1" class="form-label">Current Password</label>
                <input name="current-password" :type="show ? 'password' : 'text'" class="form-control" id="Input1"
                    placeholder="">
                @error('current-password')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="mb-3">
                <label for="password-field" class="form-label">New Password</label>

                    <input name="password" type="password" class="form-control" id="password-field"
                        placeholder="">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>


                @error('password')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password-field1" class="form-label">Confirm Password</label>

                    <input name="password_confirmation" type="password" class="form-control" id="password-field1"
                        placeholder="">
                        <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                @error('password_confirmation')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="text-center">
            <button type="submit" class="rounded btn btn-primary">
                Change Password
            </button>
            </div>
        </form>
        </div>
    </div>
</div>


@endsection
@section('footerSection')
<script>
$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
</script>

<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection
