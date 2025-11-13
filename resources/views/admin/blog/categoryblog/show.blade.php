@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="BLOG CATEGORY" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('postblog.index') }}">Blog</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('categoryblog.index') }}">Blog Category</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            BLOG CATEGORY DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('categoryblog.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">
            @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($categoryblog) && ($categoryblog->active== 0)
            ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($categoryblog) && ($categoryblog->is_top ==
            0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($categoryblog) && ($categoryblog->is_popular
            == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "FOOTER", 'value' => isset($categoryblog) && ($categoryblog->is_footer
            == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "LEFT SIDE MENU", 'value' => isset($categoryblog) &&
            ($categoryblog->is_leftsidemenu == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($categoryblog) && ($categoryblog->is_mobile
            == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CATEGORY NAME", 'value' => $categoryblog->name, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SHORT NAME", 'value' => $categoryblog->shortname, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $categoryblog->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "KEYWORD", 'value' => $categoryblog->seo_keyword, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $categoryblog->seo_description, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $categoryblog->remarks, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $categoryblog->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $categoryblog->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($categoryblog->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $categoryblog->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $categoryblog->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#blog-collapse").addClass('show');
  $("#categoryblog").css({"background-color": "#00c5d0"});
  $("#blog").css({"background-color": "#00c5d0"});
</script>
@endsection
