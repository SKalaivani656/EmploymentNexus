@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
<x-admin.layouts.adminnavbar modulename="SETTINGS" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        Settings
    </li>
</x-admin.layouts.adminbreadcrumb>

<div class="card shadow">
    <div class="card-header text-white indigo_darken_4">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight"><span class="h4">SETTINGS</span></div>
        </div>
    </div>
    <div class="card-body row g-3 mb-5">

            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm m-3 h-100">
                    <div class="card-header text-dark bg-light text-center fs-5">USER</div>
                    <div class="card-body">
                        @can('user')
                        <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/addemployee') }}">Add User</a>
                        @endcan
                        @can('changepassword')
                        <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/changepasswordform') }}">Change Password</a>
                        @endcan
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-lg-4">
                 
                 <div class="card shadow-sm m-3 h-100">
                     <div class="card-header text-dark bg-light text-center fs-5">ADMIN CONFIGURATION</div>
                     
                     <div class="card-body">
                        @can('admin-config')
                        <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/adminconfigurationweb') }}">Configuration</a>
                        @endcan
                        @can('key-config')
                        <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/adminconfigurationkey') }}">Key Configuration</a>
                        @endcan
                        <!-- <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/adminmobileconfiguration') }}">Mobile
                            Configuration</a>
                            <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/2fa') }}">2FA</a> -->
                       @can('color')
                            <a class="btn btn-success indigo_darken_4 m-1" href="{{ URL('admin/color') }}">
                         Color</a>
                        @endcan
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm m-3 h-100">
                    <div class="card-header text-dark bg-light text-center fs-5">CLEAR CACHE</div>
                    <div class="card-body">
                        <a class="btn btn-success indigo_darken_4" href="{{ URL('admin/cacheclear') }}">Clear Cache</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm m-3 h-100">
                    <div class="card-header text-dark bg-light text-center fs-5">SYSTEM INFORMATION</div>

                    <div class="card-body">
                        <a class="btn btn-success indigo_darken_4" href="{{ URL('admin/systeminfo') }}">System Info</a>
                    </div>
                </div>
            </div> -->
            <div class="col-md-6 col-lg-4">
           @can('roles-permission')
                <div class="card shadow-sm m-3 h-100">
                    <div class="card-header text-dark bg-light text-center fs-5">ROLES & PERMISSION</div>

                    <div class="card-body">
                        <a class="btn btn-success indigo_darken_4" href="{{ URL('admin/role') }}">Roles & Permission</a>
                    </div>
                </div>
            @endcan
            </div>
        </div>
    </div>
</div>


@endsection
@section('footerSection')
<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection
