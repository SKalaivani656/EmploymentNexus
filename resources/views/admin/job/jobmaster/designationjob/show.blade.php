@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="Designation" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('designationjob.index') }}">Master</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('designationjob.index') }}">designation</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            DESIGNATION DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('designationjob.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">
            @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($designationjob) &&
            ($designationjob->active== 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree'
            => "col-8"])
            @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($designationjob) && ($designationjob->is_top
            == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($designationjob) &&
            ($designationjob->is_popular == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "FOOTER", 'value' => isset($designationjob) &&
            ($designationjob->is_footer == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "LEFT SIDE MENU", 'value' => isset($designationjob) &&
            ($designationjob->is_leftsidemenu == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($designationjob) &&
            ($designationjob->is_mobile == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESIGNATION", 'value' => $designationjob->name, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SHORT NAME", 'value' => $designationjob->shortname, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            <div class="row col-md-6">
             <label class="form-label fw-bold col-4">IMAGE:</label>
              <label class="form-label col-8">
              <img src="{{ asset('storage/images/designationjob/images/'.$designationjob->image) }}" style="width:100px; Height:60px;">
            </label>
           </div>

            @include('helper.showlabel', ['name' => "IMAGE ALT", 'value' =>$designationjob->image_alttag,
             'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $designationjob->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "KEYWORD", 'value' => $designationjob->seo_keyword, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $designationjob->seo_description, 'columnone'
            =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $designationjob->remarks, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $designationjob->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $designationjob->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($designationjob->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $designationjob->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $designationjob->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#jobmaster-collapse").addClass('show');
  $("#designationjob").css({"background-color": "#00c5d0"});
  $("#jobmaster").css({"background-color": "#00c5d0"});
</script>

@endsection
