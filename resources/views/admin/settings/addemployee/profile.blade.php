@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="PROFILE" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('settings') }}">Settings</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('addemployee.index') }}">Add User</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminshow>
    <x-slot name="title">
        USER DETAILS
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('addemployee.index') }}" role="button">Back</a>
    </x-slot>
    <x-slot name="label">
        @include('helper.showlabel', ['name' => "NAME", 'value' => $addemployee->name, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "EMAIL", 'value' => $addemployee->email, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "ROLE", 'value' => $role->name, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        <div class="row col-md-6">
           <label class="form-label fw-bold col-4">AVATAR:</label>
            <label class="form-label col-8 ">
              <img src="{{ asset('/storage/images/avatar/images/'.$addemployee->avatar ) }}" style="width:100px; Height:60px;">
            </label>
        </div>
        @include('helper.showlabel', ['name' => "ADDRESS", 'value' => $addemployee->address, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "REMARKS", 'value' => $addemployee->remarks, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "STATUS", 'value' => isset($addemployee) && ($addemployee->status == 0)  ? 'Active' : 'In Active', 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $addemployee->created_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $addemployee->created_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @if($addemployee->updated_by)
        @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $addemployee->updated_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $addemployee->updated_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @endif
    </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection