@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="BLOG POST" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postblog.index') }}">Blog</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postblog.index') }}">Blog Post</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminshow>
    <x-slot name="title">
       BLOG POST DETAILS
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('postblog.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="label">
    @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($postblog) && ($postblog->active== 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($postblog) && ($postblog->is_top == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($postblog) && ($postblog->is_popular == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "IMAGE STATUS", 'value' => isset($postblog) && ($postblog->image_status == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "VIDEO STATUS", 'value' => isset($postblog) && ($postblog->video_status == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "BLOG COMMENT", 'value' => isset($postblog) && ($postblog->blogcomment == 0)  ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "TITLE", 'value' => $postblog->title, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "SUB TITLE", 'value' => $postblog->subtitle, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "SLUG", 'value' => $postblog->slug, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "SEO KEYWORD", 'value' => $postblog->seo_keyword, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "SEO DESCRIPTION", 'value' => $postblog->seo_description, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        <div class="row col-md-6">
           <label class="form-label fw-bold col-4">IMAGE:</label>
            <label class="form-label col-8 ">
              <img src="{{ asset('/storage/images/blog/images/'.$postblog->image ) }}" style="width:100px; Height:60px;">
            </label>
        </div>

        {{-- Storage::url("/storage/app/{$images->filename}") --}}
        @include('helper.showlabel', ['name' => "VIDEO LINK", 'value' => $postblog->video_link, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CATEGORY", 'value' => $postblog->categoryblog->pluck('name')->implode(', '), 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "TAG", 'value' => $postblog->tagblog->pluck('name')->implode(', '), 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "COUNTRY", 'value' => $postblog->country, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "STATE", 'value' => $postblog->state, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CITY", 'value' => $postblog->city, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $postblog->short_description, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "BODY", 'value' => $postblog->body, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "REMARKS", 'value' => $postblog->remarks, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $postblog->created_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $postblog->created_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @if($postblog->updated_by)
        @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $postblog->updated_at, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $postblog->updated_by, 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
        @endif
    </x-slot>

</x-admin.layouts.adminshow>

@endsection
@section('footerSection')
<script>
  $("#blog-collapse").addClass('show');
  $("#postblog").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#blog").css({"background-color": "#00c5d0"});
</script>
@endsection
