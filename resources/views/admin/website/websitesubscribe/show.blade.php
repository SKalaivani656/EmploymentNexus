@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="ENQUIRY" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websiteenquiry.index') }}">Website</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websiteenquiry.index') }}">Websiteenquiry</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminshow>
    <x-slot name="title">
    ROLE DETAILS
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('websiteenquiry.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="label">
       @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($websiteenquiry) && ($websiteenquiry->active== 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
       @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($websiteenquiry) && ($websiteenquiry->is_mobile== 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "FIRST NAME", 'value' => $websiteenquiry->fname, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "LAST NAME", 'value' => $websiteenquiry->lname, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "EMAIL", 'value' => $websiteenquiry->mail, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "REMARKS", 'value' => $websiteenquiry->remarks, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $websiteenquiry->created_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $websiteenquiry->created_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @if($websiteenquiry->updated_by)
        @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $websiteenquiry->updated_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $websiteenquiry->updated_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @endif
    </x-slot>

</x-admin.layouts.adminshow>

@endsection
@section('footerSection')
<script>
  $("#website-collapse").addClass('show');
  $("#websitesubscribe").css({"background-color": "#00c5d0"});
  $("#website").css({"background-color": "#00c5d0"});
</script>
@endsection
