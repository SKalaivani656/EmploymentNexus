@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="ADD USER" />
@endsection

@section('main-content')


<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('settings') }}">Settings</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('addemployee.index') }}">Add User</a>
    </li>
    
    <li class="breadcrumb-item active" aria-current="page">{{ (!$addemployee->id) ? 'Create':  'Update'}} </li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.admincreateorupdate>
    <x-slot name="title">
       CREATE USER 
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('addemployee.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="form">
    {!! Form::model($addemployee, ['route' => ['addemployee.store', $addemployee->id],  'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
    {{ Form::hidden('id', $addemployee->id, array('id' => 'invisible_id')) }}
    {{ Form::hidden('uniqid', $addemployee->uniqid, array('id' => 'invisible_id')) }}

    @include('admin.settings.addemployee.form') 

    <div class="text-center mt-3">
    @if ($addemployee->id)
    {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> UPDATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits'] ) !!}
    @else
    {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> CREATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits'] ) !!}
    @endif
    <a href="" class="shadow btn btn-danger rounded">CANCEL</a>
    </div>

    {!! Form::close() !!}
</x-slot>

</x-admin.layouts.admincreateorupdate>


@endsection
@section('footerSection')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" />
<script>
    $('#datepicker1').datepicker({
        format: 'dd/mm/yyyy'
    });
    $('#datepicker2').datepicker({
        format: 'dd/mm/yyyy'
    });
</script> -->

<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection










