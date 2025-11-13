<div class="col-md-2">
    {!! Form::checkbox('active', null, isset($tagblog) ? $tagblog->active : 0, ['id' => 'branchactive', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchactive", 'name' => "ACTIVE", 'required' => false])
    @include('helper.formerror', ['error' => "active"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_top', null, isset($tagblog) ? $tagblog->is_top : 0, ['id' => 'branchistop', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchistop", 'name' => "IS TOP", 'required' => false])
    @include('helper.formerror', ['error' => "is_top"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_popular', null, isset($tagblog) ? $tagblog->is_popular : 0, ['id' => 'branchispopular', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchispopular", 'name' => "IS POPULAR", 'required' => false])
    @include('helper.formerror', ['error' => "is_popular"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_footer', null, isset($tagblog) ? $tagblog->is_footer : 0, ['id' => 'branchisfooter', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchisfooter", 'name' => "IS FOOTER", 'required' => false])
    @include('helper.formerror', ['error' => "is_footer"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_leftsidemenu', null, isset($tagblog) ? $tagblog->is_leftsidemenu : 0, ['id' => 'branchisleftsidemenu', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchisleftsidemenu", 'name' => "IS LEFTSIDE MENU", 'required' =>
    false])
    @include('helper.formerror', ['error' => "is_leftsidemenu"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_mobile', null, isset($tagblog) ? $tagblog->is_mobile : 0, ['id' => 'branchismobile', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchismobile", 'name' => "IS MOBILE", 'required' => false])
    @include('helper.formerror', ['error' => "is_mobile"])
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "position", 'name' => "POSITION", 'required' => false])
    {{ Form::text('position', $tagblog->position, ['id' => 'position', 'class' => 'form-control', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "position"])
</div>
<div class="col-md-9">
    @include('helper.formlabel', ['id'=>'', 'for' => "tagblog", 'name' => "TAG NAME", 'required' => true])
    {{ Form::text('name', $tagblog->name, ['id' => 'tagblog', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "name"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'shortnametitleLeft', 'for' => "shortname", 'name' => "SHORT NAME", 'required'
    => true])
    {{ Form::text('shortname', $tagblog->shortname, ['id' => 'shortname', 'maxlength' => '20', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "shortname"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'slugtitleLeft', 'for' => "slug", 'name' => "SLUG", 'required' => true])
    {{ Form::text('slug', $tagblog->slug, ['id' => 'slug', 'maxlength' => '80', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "slug"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'keywordtitleLeft', 'for' => "keyword", 'name' => "SEO KEYWORD", 'required' =>
    true])
    {{ Form::text('seo_keyword', $tagblog->seo_keyword, ['id' => 'keyword', 'maxlength' => '165', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "seo_keyword"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'descriptiontitleLeft', 'for' => "description", 'name' => "SEO DESCRIPTION",
    'required' => true])
    {{ Form::textarea('seo_description', $tagblog->seo_description, ['id' => 'description', 'maxlength' => '200', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "seo_description"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARK", 'required' => false])
    {{ Form::textarea('remarks', $tagblog->remarks, ['id' => 'remarks', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "remarks"])
</div>
