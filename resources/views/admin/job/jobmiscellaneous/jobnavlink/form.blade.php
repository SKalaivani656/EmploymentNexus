<div class="col-md-2">
   {!! Form::checkbox('active',  null,  isset($jobnavlink) ? $jobnavlink->active : 0 ,array('id'=>'jobnavlinkactive','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "jobnavlinkactive",'name' => "ACTIVE", 'required' => false])
   @include('helper.formerror', ['error' => "active"])
</div>
<div class="col-md-2">
   {!! Form::checkbox('is_top',  null,  isset($jobnavlink) ? $jobnavlink->is_top : 0 ,array('id'=>'jobnavlinkistop','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "jobnavlinkistop", 'name' => "IS TOP", 'required' => false])
   @include('helper.formerror', ['error' => "is_top"])
</div>
<div class="col-md-2">
   {!! Form::checkbox('is_popular',  null,  isset($jobnavlink) ? $jobnavlink->is_popular : 0 ,array('id'=>'jobnavlinkispopular','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "jobnavlinkispopular", 'name' => "IS POPULAR", 'required' => false])
   @include('helper.formerror', ['error' => "is_popular"])
</div>
<div class="col-md-2">
   {!! Form::checkbox('is_footer',  null,  isset($jobnavlink) ? $jobnavlink->is_footer : 0 ,array('id'=>'jobnavlinkisfooter','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "jobnavlinkisfooter", 'name' => "IS FOOTER", 'required' => false])
   @include('helper.formerror', ['error' => "is_footer"])
</div>

<div class="col-md-2">
   {!! Form::checkbox('is_mobile',  null,  isset($jobnavlink) ? $jobnavlink->is_mobile : 0 ,array('id'=>'jobnavlinkismobile','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "jobnavlinkismobile", 'name' => "IS MOBILE", 'required' => false])
   @include('helper.formerror', ['error' => "is_mobile"])
</div>
<div class="col-md-2">
   @include('helper.formlabel', ['id'=>'',  'for' => "position", 'name' => "POSITION", 'required' => false])
   {{ Form::text('position', $jobnavlink->position, array('id'=>'position', 'class'=>'form-control', 'readonly'=>'readonly')) }}
   @include('helper.formerror', ['error' => "position"])
</div>
<div class="col-md-6">
   @include('helper.formlabel', ['id'=>'',  'for' => "jobnavlink", 'name' => "JOB NAVLINK", 'required' => true])
   {{ Form::text('name', $jobnavlink->name, array('id'=>'jobnavlink', 'class'=>'form-control')) }}
   @include('helper.formerror', ['error' => "name"])

</div>

<div class="col-md-6">
   @include('helper.formlabel', ['id'=>'shortnametitleLeft',  'for' => "shortname", 'name' => "SHORT NAME", 'required' => true])
   {{ Form::text('shortname', $jobnavlink->shortname, array('id'=>'shortname','maxlength'=>'20', 'class'=>'form-control')) }}
   @include('helper.formerror', ['error' => "shortname"])
</div>
<div class="col-md-6">
   @include('helper.formlabel', ['id'=>'',  'for' => "link", 'name' => "LINK", 'required' => false])
   {{ Form::text('link', $jobnavlink->link, array('id'=>'link', 'class'=>'form-control')) }}
   @include('helper.formerror', ['error' => "link"])
</div>

<div class="col-md-6">
   @include('helper.formlabel', ['id'=>'',  'for' => "remarks", 'name' => "REMARK", 'required' => false])
   {{ Form::textarea('remarks',$jobnavlink->remarks ,array('id'=>'remarks','class'=>'form-control', 'rows'=>'2')) }}
   @include('helper.formerror', ['error' => "remarks"])
</div>
