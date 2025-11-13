@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="VIDEO POST" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('postvideo.index') }}">Video</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('postvideo.index') }}">Video Post</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            VIDEO POST DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('postvideo.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">


            @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($postvideo) && ($postvideo->active== 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($postvideo) && ($postvideo->is_top == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($postvideo) && ($postvideo->is_popular == 0)
            ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            {{-- @include('helper.showlabel', ['name' => "VIDEO STATUS", 'value' => isset($postvideo) && ($postvideo->video_status == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "VIDEO COMMENT", 'value' => isset($postvideo) && ($postvideo->blogcomment == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"]) --}}
            @include('helper.showlabel', ['name' => "POST NAME", 'value' => $postvideo->title, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $postvideo->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            <div class="row col-md-6">
                <label class="form-label fw-bold col-4">POSTED ON</label>
                <label class="form-label col-8 ">
                    <b>:</b>{{ date('d-m-Y', strtotime($postvideo->posted_on)) }}
                </label>
            </div>
            @include('helper.showlabel', ['name' => "LINK", 'value' => $postvideo->link, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "IMAGE LINK", 'value' => $postvideo->img_link, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DOWNLOAD LINK", 'value' => $postvideo->download_link, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "KEYWORD", 'value' => $postvideo->seo_keyword, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $postvideo->seo_description, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $postvideo->remarks, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $postvideo->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $postvideo->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($postvideo->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $postvideo->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $postvideo->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

    <script>
        $("#video-collapse").addClass('show');
        $("#postvideo").css({
            "background-color": "#00c5d0",
            "margin-top": "2px"
        });
        $("#video").css({
            "background-color": "#00c5d0"
        });

    </script>
@endsection
