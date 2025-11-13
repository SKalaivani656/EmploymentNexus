@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="COMPANY" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('companyjob.index') }}">Master</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('companyjob.index') }}">COMPANY</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            COMPANY DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('companyjob.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">
            @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($companyjob) && ($companyjob->active== 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($companyjob) && ($companyjob->is_top == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($companyjob) && ($companyjob->is_popular ==
            0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "FOOTER", 'value' => isset($companyjob) && ($companyjob->is_footer == 0)
            ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "LEFT SIDE MENU", 'value' => isset($companyjob) &&
            ($companyjob->is_leftsidemenu == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($companyjob) && ($companyjob->is_mobile == 0)
            ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "COMPANY NAME", 'value' => $companyjob->name, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SHORT NAME", 'value' => $companyjob->shortname, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            <div class="row col-md-6">
             <label class="form-label fw-bold col-4">IMAGE:</label>
              <label class="form-label col-8">
              <img src="{{ asset('storage/images/companyjob/images/'.$companyjob->image) }}" style="width:100px; Height:60px;">
            </label>
           </div>

            @include('helper.showlabel', ['name' => "IMAGE ALT", 'value' =>$companyjob->image_alttag,
             'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $companyjob->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "KEYWORD", 'value' => $companyjob->seo_keyword, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $companyjob->seo_description, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $companyjob->remarks, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $companyjob->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $companyjob->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($companyjob->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $companyjob->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $companyjob->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#jobmaster-collapse").addClass('show');
  $("#companyjob").css({"background-color": "#00c5d0"});
  $("#jobmaster").css({"background-color": "#00c5d0"});
</script>

@endsection
