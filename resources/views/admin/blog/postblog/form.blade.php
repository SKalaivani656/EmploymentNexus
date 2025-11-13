<div class="col-md-2">
    {!! Form::checkbox('active', null, isset($postblog) ? $postblog->active : 0, ['id' => 'is_active', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_active", 'name' => "ACTIVE ", 'required' => true])
    @include('helper.formerror', ['error' => "active"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_top', null, isset($postblog) ? $postblog->is_top : 0, ['id' => 'is_top', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_top", 'name' => "TOP BLOGS ", 'required' => false])
    @include('helper.formerror', ['error' => "is_top"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_popular', null, isset($postblog) ? $postblog->is_popular : 0, ['id' => 'is_popular', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_popular", 'name' => "POPULAR ", 'required' => false])
    @include('helper.formerror', ['error' => "is_popular"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('image_status', null, isset($postblog) ? $postblog->image_status : 0, ['id' => 'image_status', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "image_status", 'name' => "IMAGE STATUS", 'required' => false])
    @include('helper.formerror', ['error' => "image_status"])
</div>

<div class="col-md-2">
    {!! Form::checkbox('video_status', null, isset($postblog) ? $postblog->video_status : 0, ['id' => 'video_status', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "video_status", 'name' => "VIDEO STATUS", 'required' => false])
    @include('helper.formerror', ['error' => "video_status"])
</div>

<div class="col-md-2">
    {!! Form::checkbox('blogcomment', null, isset($postblog) ? $postblog->blogcomment : 0, ['id' => 'blogcomment', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "blogcomment", 'name' => "BLOG COMMENT", 'required' => false])
    @include('helper.formerror', ['error' => "blogcomment"])
</div>

<div class="col-md-2 d-none">
    @include('helper.formlabel', ['id'=>'', 'for' => "position", 'name' => "POSITION", 'required' => false])
    {{ Form::text('position', $postblog->position, ['id' => 'position', 'class' => 'form-control', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "position"])
</div>


<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'titleLeft', 'for' => "title", 'name' => "TITLE", 'required' => true, ])
    {{ Form::text('title', $postblog->title, ['id' => 'title', 'maxlength' => 80, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "title"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'subtitleLeft', 'for' => "subtitle", 'name' => "SUB TITLE", 'required' => true])
    {{ Form::text('subtitle', $postblog->subtitle, ['id' => 'subtitle', 'maxlength' => 100, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "subtitle"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'slugtitleLeft', 'for' => "slug", 'name' => "SLUG", 'required' => true])
    {{ Form::text('slug', $postblog->slug, ['id' => 'slug', 'maxlength' => 100, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "slug"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "image", 'name' => "IMAGE", 'required' => false])
    <input type="file" name="image" accept="image/*" id="image" class="form-control">
    <small class="text-success"> {{ $postblog->image }} </small>
    @include('helper.formerror', ['error' => "image"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "image_alttag", 'name' => "IMAGE ALT", 'required'
    => false])
    {{ Form::text('image_alttag', $postblog->image_alttag, ['id' => 'image_alttag', 'maxlength' => '20', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "image_alttag"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "video_link", 'name' => "VIDEO LINK", 'required' => false])
    {{ Form::text('video_link', $postblog->video_link, ['id' => 'video_link', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "video_link"])
</div>




<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'keywordtitleLeft', 'for' => "seo_keyword", 'name' => "SEO KEYWORD", 'required'
    => true])
    {{ Form::text('seo_keyword', $postblog->seo_keyword, ['id' => 'seo_keyword', 'maxlength' => 255, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "seo_keyword"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'descriptiontitleLeft', 'for' => "seo_description", 'name' => "SEO DESCRIPTION",
    'required' => true])
    {{ Form::textarea('seo_description', $postblog->seo_description, ['id' => 'seo_description', 'maxlength' => 165, 'class' => 'form-control', 'rows' => 2]) }}
    @include('helper.formerror', ['error' => "seo_description"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "categoryoption", 'name' => "CATEGORY", 'required' => false])
    <select name="category_select[]" style="width:100%;" id="categoryoption" value="{{ $postblog->categorySelect }}"
        class="form-control input-lg dynamic js-example-basic-multiple" multiple="multiple">
        <option value="">Select Category</option>
    </select>
    @include('helper.formerror', ['error' => "category_select"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "tagoption", 'name' => "TAG", 'required' => false])
    <select name="tag_select[]" id="tagoption" style="width:100%;" value="{{ $postblog->tagSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select tag</option>
    </select>
    @include('helper.formerror', ['error' => "tag_select"])
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "country_id", 'name' => "SELECT COUNTRY", 'required' => false])
    {{ Form::select('country_id', $countries, $postblog->country_id, ['id' => 'country_id', 'class' => 'form-select js-example-basic-single', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "country_id"])
</div>

<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "state_id", 'name' => "SELECT STATE", 'required' => false])
    <select name="state_id" id="state_id" class="form-select js-example-basic-single"></select>
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "city_id", 'name' => "SELECT CITY", 'required' => false])
    <select name="city_id" id="city_id" class="form-select js-example-basic-single"></select>
</div>

<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "posted_on", 'name' => "POSTED ON", 'required' => false])
    <input type="date" name="posted_on" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postblog->posted_on }}>
    @include('helper.formerror', ['error' => "posted_on"])
</div>

<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "short_description", 'name' => "DESCRIPTION", 'required' => true])
    {{ Form::textarea('short_description', $postblog->short_description, ['id' => 'short_description', 'class' => 'form-control short_description ']) }}
    @include('helper.formerror', ['error' => "short_description"])

</div>

<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "body", 'name' => "BODY", 'required' => true])
    {{ Form::textarea('body', $postblog->body, ['id' => 'body', 'class' => 'form-control body ']) }}
    @include('helper.formerror', ['error' => "body"])

</div>


<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "schemaorg", 'name' => "SCHEMA ORG", 'required' => true])
    {{ Form::textarea('schemaorg', $postblog->schemaorg, ['id' => 'schemaorg', 'class' => 'form-control', 'rows' => '3']) }}
    @include('helper.formerror', ['error' => "schemaorg"])
</div>


<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARK", 'required' => false])
    {{ Form::textarea('remarks', $postblog->remarks, ['id' => 'remarks', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "remarks"])
</div>
