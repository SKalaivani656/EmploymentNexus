@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="BRANCH" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('role.index') }}">Settings</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('role.index') }}">Role</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ (!$role->id) ? 'Create':  'Update'}} </li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.admincreateorupdate>
    <x-slot name="title">
       CREATE ROLE
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('role.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="form">
    {!! Form::model($role, ['route' => ['role.store', $role->id],  'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
    {{ Form::hidden('id', $role->id, array('id' => 'invisible_id')) }}
    {{ Form::hidden('uniqid', $role->uniqid, array('id' => 'invisible_id')) }}

    @include('admin.settings.rolesandpermission.role.form')

    <div class="text-center mt-3">
    @if ($role->id)
    {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> UPDATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits'] ) !!}
    @else
    {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> CREATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits'] ) !!}
    @endif
    <a href="" class="shadow btn  btn-sm btn-danger rounded">CANCEL</a>
    </div>

    {!! Form::close() !!}
</x-slot>

</x-admin.layouts.admincreateorupdate>


@endsection
@section('footerSection')

<script type="text/javascript">
   $(document).ready(function () {
      $("#ckbCheckAll").click(function () {
     $(".form-checkbox").prop('checked', $(this).prop('checked'));
 });
});
 </script>

<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection
