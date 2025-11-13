@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="WEBSITE MARQUEE" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websitemarquee.index') }}">Website</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websitemarquee.index') }}">WebsiteMarquee</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminshow>
    <x-slot name="title">
    MARQUEE DETAILS
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('websitemarquee.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="label">
       @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($websitemarquee) && ($websitemarquee->active== 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])

        @include('helper.showlabel', ['name' => "MARQUEE NAME", 'value' =>strip_tags( $websitemarquee->marquee), 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "MARQUEE NAME", 'value' => Config('archive.marqueetype' )[$websitemarquee->marqueetype], 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "REMARKS", 'value' => $websitemarquee->remarks, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $websitemarquee->created_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $websitemarquee->created_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @if($websitemarquee->updated_by)
        @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $websitemarquee->updated_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $websitemarquee->updated_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @endif
    </x-slot>

</x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#website-collapse").addClass('show');
  $("#websitemarquee").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#website").css({"background-color": "#00c5d0"});
</script>
@endsection
