<div class="col-md-2">
    {!! Form::checkbox('active', null, isset($branchjob) ? $branchjob->active : 0, ['id' => 'branchactive', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchactive",'name' => "ACTIVE", 'required' => false])
    @include('helper.formerror', ['error' => "active"])
</div>
<div class="col-md-1">
    {!! Form::checkbox('is_image', null, isset($branchjob) ? $branchjob->is_image : 0, ['id' => 'is_image', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_image", 'name' => "IMAGE", 'required' => false])
    @include('helper.formerror', ['error' => "is_image"])
</div>
<div class="col-md-1">
    {!! Form::checkbox('is_top', null, isset($branchjob) ? $branchjob->is_top : 0, ['id' => 'branchistop', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchistop", 'name' => "IS TOP", 'required' => false])
    @include('helper.formerror', ['error' => "is_top"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_popular', null, isset($branchjob) ? $branchjob->is_popular : 0, ['id' => 'branchispopular', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchispopular", 'name' => "IS POPULAR", 'required' => false])
    @include('helper.formerror', ['error' => "is_popular"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_footer', null, isset($branchjob) ? $branchjob->is_footer : 0, ['id' => 'branchisfooter', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchisfooter", 'name' => "IS FOOTER", 'required' => false])
    @include('helper.formerror', ['error' => "is_footer"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_leftsidemenu', null, isset($branchjob) ? $branchjob->is_leftsidemenu : 0, ['id' => 'branchisleftsidemenu', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchisleftsidemenu", 'name' => "IS LEFTSIDE MENU", 'required' =>
    false])
    @include('helper.formerror', ['error' => "is_leftsidemenu"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_mobile', null, isset($branchjob) ? $branchjob->is_mobile : 0, ['id' => 'branchismobile', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "branchismobile", 'name' => "IS MOBILE", 'required' => false])
    @include('helper.formerror', ['error' => "is_mobile"])
</div>
<div class="col-md-9">
    @include('helper.formlabel', ['id'=>'titleLeft', 'for' => "branch", 'name' => "BRANCH NAME", 'required' => true])
    {{ Form::text('name', $branchjob->name, ['id' => 'branch', 'maxlength' => '55', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "name"])

</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "position", 'name' => "POSITION", 'required' => false])
    {{ Form::text('position', $branchjob->position, ['id' => 'position', 'class' => 'form-control', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "position"])
</div>

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "fullname", 'name' => "FULL NAME", 'required' => true])
    {{ Form::text('fullname', $branchjob->fullname, ['id' => 'fullname', 'maxlength' => '50', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "fullname"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "degree", 'name' => "DEGREE", 'required' => true])
    {{ Form::text('degree', $branchjob->degree, ['id' => 'degree', 'maxlength' => '50', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "degree"])
</div>




<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'shortnametitleLeft', 'for' => "shortname", 'name' => "SHORT NAME", 'required'
    => true])
    {{ Form::text('shortname', $branchjob->shortname, ['id' => 'shortname', 'maxlength' => '20', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "shortname"])
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "image", 'name' => "IMAGE", 'required' => false])
    <input type="file" name="image" accept="image/*" id="image" class="form-control">
    <span> {{ $branchjob->image }} </span>
    @include('helper.formerror', ['error' => "image"])
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "image_alttag", 'name' => "IMAGE ALT", 'required'
    => false])
    {{ Form::text('image_alttag', $branchjob->image_alttag, ['id' => 'image_alttag', 'maxlength' => '20', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "image_alttag"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'slugtitleLeft', 'for' => "slug", 'name' => "SLUG", 'required' => true])
    {{ Form::text('slug', $branchjob->slug, ['id' => 'slug', 'maxlength' => '80', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "slug"])
</div>
</div>



<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'keywordtitleLeft', 'for' => "keyword", 'name' => "SEO KEYWORD", 'required' =>
    true])
    {{ Form::text('seo_keyword', $branchjob->seo_keyword, ['id' => 'keyword', 'maxlength' => '150', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "seo_keyword"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'descriptiontitleLeft', 'for' => "description", 'name' => "SEO DESCRIPTION",
    'required' => true])
    {{ Form::textarea('seo_description', $branchjob->seo_description, ['id' => 'description', 'maxlength' => '200', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "seo_description"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARK", 'required' => false])
    {{ Form::textarea('remarks', $branchjob->remarks, ['id' => 'remarks', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "remarks"])
</div>
