@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="JOB NAV LINK" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('jobnavlink.index') }}">Jobmiscellaneous</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('jobnavlink.index') }}">Jobnavlink</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminshow>
    <x-slot name="title">
    JOB NAV LINK DETAILS
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('jobnavlink.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="label">
        @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($jobnavlink) && ($jobnavlink->active== 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($jobnavlink) && ($jobnavlink->is_top == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($jobnavlink) && ($jobnavlink->is_popular == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "FOOTER", 'value' => isset($jobnavlink) && ($jobnavlink->is_footer == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($jobnavlink) && ($jobnavlink->is_mobile == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "JOB NAV LINK NAME", 'value' => $jobnavlink->name, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "REMARKS", 'value' => $jobnavlink->remarks, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $jobnavlink->created_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $jobnavlink->created_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @if($jobnavlink->updated_at)
        @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $jobnavlink->updated_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $jobnavlink->updated_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @endif
    </x-slot>

</x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#jobnavlink-collapse").addClass('show');
  $("#jobnavlink").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#jobmiscellaneous").css({"background-color": "#00c5d0"});
</script>
@endsection
