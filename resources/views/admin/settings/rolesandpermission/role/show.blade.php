@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="ROLE" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('role.index') }}">Settings</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('role.index') }}">skill</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminshow>
    <x-slot name="title">
    ROLE DETAILS
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('role.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="label">
        @include('helper.showlabel', ['name' => "ROLE NAME", 'value' => $role->name, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $role->created_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $role->created_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @if($role->updated_by)
        @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $role->updated_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $role->updated_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @endif
    </x-slot>

</x-admin.layouts.adminshow>

@endsection
@section('footerSection')
<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection
