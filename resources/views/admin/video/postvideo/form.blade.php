<div class="col-md-2">
    {!! Form::checkbox('active', null, isset($postvideo) ? $postvideo->active : 0, ['id' => 'is_active', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_active", 'name' => "ACTIVE ", 'required' => true])
    @include('helper.formerror', ['error' => "active"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_top', null, isset($postvideo) ? $postvideo->is_top : 0, ['id' => 'is_top', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_top", 'name' => "TOP JOBS ", 'required' => false])
    @include('helper.formerror', ['error' => "is_top"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_popular', null, isset($postvideo) ? $postvideo->is_popular : 0, ['id' => 'is_popular', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_popular", 'name' => "POPULAR ", 'required' => false])
    @include('helper.formerror', ['error' => "is_popular"])
</div>


{{-- <div  class="col-md-2">
   {!! Form::checkbox('video_status',  null,  isset($postvideo) ? $postvideo->video_status : 0 ,array('id'=>'video_status','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "video_status", 'name' => "VIDEO STATUS", 'required' => false])
   @include('helper.formerror', ['error' => "video_status"])
</div>

<div  class="col-md-2">
   {!! Form::checkbox('videocomment',  null,  isset($postvideo) ? $postvideo->videocomment : 0 ,array('id'=>'videocomment','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "videocomment", 'name' => "VIDEO COMMENT", 'required' => false])
   @include('helper.formerror', ['error' => "videocomment"])
</div> --}}

<div class="col-md-2 d-none">
    @include('helper.formlabel', ['id'=>'', 'for' => "position", 'name' => "POSITION", 'required' => false])
    {{ Form::text('position', $postvideo->position, ['id' => 'position', 'class' => 'form-control', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "position"])
</div>


<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'titleLeft', 'for' => "title", 'name' => "TITLE", 'required' => true, ])
    {{ Form::text('title', $postvideo->title, ['id' => 'title', 'maxlength' => 80, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "title"])
</div>

<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'slugtitleLeft', 'for' => "slug", 'name' => "SLUG", 'required' => true])
    {{ Form::text('slug', $postvideo->slug, ['id' => 'slug', 'maxlength' => 100, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "slug"])
</div>

<div class="col-md-8">
    @include('helper.formlabel', ['id'=>'', 'for' => "video_id", 'name' => "VIDEO ID", 'required' => false])
    {{ Form::text('video_id', $postvideo->video_id, ['id' => 'video_id', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "video_id"])
</div>
{{-- <div class="col-md-6">
   @include('helper.formlabel', ['id'=>'',  'for' => "img_link", 'name' => "IMAGE LINK", 'required' => false])
   {{ Form::text('img_link', $postvideo->img_link, array('id'=>'img_link', 'class'=>'form-control')) }}
   @include('helper.formerror', ['error' => "img_link"])
</div>
<div class="col-md-6">
   @include('helper.formlabel', ['id'=>'',  'for' => "download_link", 'name' => "DOWNLOAD LINK", 'required' => false])
   {{ Form::text('download_link', $postvideo->download_link, array('id'=>'download_link', 'class'=>'form-control')) }}
   @include('helper.formerror', ['error' => "download_link"])
</div> --}}


<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "posted_on", 'name' => "POSTED ON", 'required' => false])
    <input type="date" name="posted_on" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postvideo->posted_on }}>
    @include('helper.formerror', ['error' => "posted_on"])
</div>

<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'keywordtitleLeft', 'for' => "seo_keyword", 'name' => "SEO KEYWORD", 'required'
    => true])
    {{ Form::text('seo_keyword', $postvideo->seo_keyword, ['id' => 'seo_keyword', 'maxlength' => 255, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "seo_keyword"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'descriptiontitleLeft', 'for' => "seo_description", 'name' => "SEO DESCRIPTION",
    'required' => true])
    {{ Form::textarea('seo_description', $postvideo->seo_description, ['id' => 'seo_description', 'maxlength' => 165, 'class' => 'form-control', 'rows' => 2]) }}
    @include('helper.formerror', ['error' => "seo_description"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "categoryoption", 'name' => "VIDEO CATEGORY", 'required' => false])
    <select name="category_select[]" style="width:100%;" id="categoryoption" value="{{ $postvideo->categorySelect }}"
        class="form-control input-lg dynamic js-example-basic-multiple" multiple="multiple">
        <option value="">Select Category</option>
    </select>
    @include('helper.formerror', ['error' => "category_select"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "tagoption", 'name' => "VIDEO TAG", 'required' => false])
    <select name="tag_select[]" id="tagoption" style="width:100%;" value="{{ $postvideo->tagSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select tag</option>
    </select>
    @include('helper.formerror', ['error' => "tag_select"])
</div>



<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "body", 'name' => "BODY", 'required' => true])
    {{ Form::textarea('body', $postvideo->body, ['id' => 'body', 'class' => 'form-control body ']) }}
    @include('helper.formerror', ['error' => "body"])

</div>

<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "schemaorg", 'name' => "SCHEMA ORG", 'required' => true])
    {{ Form::textarea('schemaorg', $postvideo->schemaorg, ['id' => 'schemaorg', 'class' => 'form-control', 'rows' => '3']) }}
    @include('helper.formerror', ['error' => "schemaorg"])
</div>


<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARK", 'required' => false])
    {{ Form::textarea('remarks', $postvideo->remarks, ['id' => 'remarks', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "remarks"])
</div>
