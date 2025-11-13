@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="post" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>

        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('postjob.index') }}"> Job Post</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            JOB POST DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('postjob.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">

            @include('helper.showlabel', ['name' => "IMAGE STATUS", 'value' => isset($postjob) && ($postjob->image_status ==
            0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "VIDEO STATUS", 'value' => isset($postjob) && ($postjob->video_status ==
            0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TITLE", 'value' => $postjob->title, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SUB TITLE", 'value' => $postjob->subtitle, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $postjob->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SEO KEYWORD", 'value' => $postjob->seo_keyword, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SEO DESCRIPTION", 'value' => $postjob->seo_description, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            <div class="row col-md-6">
                <label class="form-label fw-bold col-4">IMAGE:</label>
                <label class="form-label col-8">
                    <img src="{{ asset('storage/images/jobpost/images/' . $postjob->image) }}"
                        style="width:100px; Height:60px;">
                </label>
            </div>
            @include('helper.showlabel', ['name' => "VIDEO LINK", 'value' => $postjob->video_link, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "BRANCH", 'value' => $postjob->branchjob->pluck('name')->implode(', '),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CATEGORY", 'value' => $postjob->categoryjob->pluck('name')->implode(',
            '), 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "COURSE", 'value' => $postjob->coursejob->pluck('name')->implode(', '),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "COMPANY", 'value' => $postjob->companyjob->pluck('name')->implode(',
            '), 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "LANGUAGE", 'value' => $postjob->languagejob->pluck('name')->implode(',
            '), 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "ROLE", 'value' => $postjob->rolejob->pluck('name')->implode(', '),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SKILL", 'value' => $postjob->skilljob->pluck('name')->implode(', '),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TAG", 'value' => $postjob->tagjob->pluck('name')->implode(', '),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TYPE", 'value' => $postjob->typejob->pluck('name')->implode(', '),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SECTOR", 'value' => Config::get('archive.sector')[$postjob->sector],
            'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TOTAL VACANCY", 'value' => $postjob->total_vacancy, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MIN SALARY", 'value' => $postjob->min_sal, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MIN EXPERIENCE", 'value' => $postjob->min_exp, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MAX EXPERIENCE", 'value' => $postjob->max_exp, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MIN AGE", 'value' => $postjob->min_age, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MAX AGE", 'value' => $postjob->max_age, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "COUNTRY", 'value' => $postjob->country, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "STATE", 'value' => $postjob->state, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CITY", 'value' => $postjob->city, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => strip_tags($postjob->short_description),
            'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "BODY", 'value' =>strip_tags ($postjob->body), 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $postjob->remarks, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $postjob->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $postjob->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($postjob->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $postjob->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $postjob->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

    <script>
        $("#postjob").css({
            "background-color": "#00c5d0"
        });

    </script>
@endsection
