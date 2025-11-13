@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="COURSE" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('coursejob.index') }}">Master</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('coursejob.index') }}">Course</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            COURSE DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('coursejob.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">
            @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($coursejob) && ($coursejob->active== 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($coursejob) && ($coursejob->is_top == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($coursejob) && ($coursejob->is_popular == 0)
            ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "FOOTER", 'value' => isset($coursejob) && ($coursejob->is_footer == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "LEFT SIDE MENU", 'value' => isset($coursejob) &&
            ($coursejob->is_leftsidemenu == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($coursejob) && ($coursejob->is_mobile == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "COURSE NAME", 'value' => $coursejob->name, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "ONLY NAME", 'value' => $coursejob->onlyname, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SHORT NAME", 'value' => $coursejob->shortname, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            <div class="row col-md-6">
                <label class="form-label fw-bold col-4">IMAGE:</label>
                <label class="form-label col-8">
                    <img src="{{ asset('storage/images/coursejob/images/' . $coursejob->image) }}"
                        style="width:100px; Height:60px;">
                </label>
            </div>

            @include('helper.showlabel', ['name' => "IMAGE ALT", 'value' =>$coursejob->image_alttag,
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $coursejob->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "KEYWORD", 'value' => $coursejob->seo_keyword, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $coursejob->seo_description, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $coursejob->remarks, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $coursejob->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $coursejob->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($coursejob->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $coursejob->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $coursejob->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')


    <script>
        $("#jobmaster-collapse").addClass('show');
        $("#coursejob").css({
            "background-color": "#00c5d0"
        });
        $("#jobmaster").css({
            "background-color": "#00c5d0"
        });

    </script>
@endsection
