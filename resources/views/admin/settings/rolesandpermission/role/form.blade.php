
<div class="col-md-4">
   @include('helper.formlabel', ['id'=>'',  'for' => "name", 'name' => "ROLE", 'required' => true])
   {{ Form::text('name', $role->name, array('id'=>'name', 'class'=>'form-control')) }}
   @include('helper.formerror', ['error' => "name"])
</div>


  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
      <input type="checkbox" style="height:20px; width:30px;" class="form-checkbox  fs-5" id="ckbCheckAll"/>
        <i class="fas fa-list mr-3"></i> ADMIN SIDE NAVBAR
   </p>

   @foreach($permission->where('permissionsheading', "side_nav")->chunk(4) as $chunk)
   <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
              <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
              {{ $value->name }}</label>
            </div>
            @endforeach
  </div>
 @endforeach


{{-----branch----}}

<p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>BRANCH
</p>


@foreach($permission->where('permissionsheading', "branch")->chunk(4) as $chunk)
<div class="d-flex flex-row m-4 fs-5 fw-bolder">
         @foreach($chunk as $value)
         <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----category----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>CATEGORY
</p>

 @foreach($permission->where('permissionsheading', "category")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach




{{-----company----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>COMPANY
</p>

 @foreach($permission->where('permissionsheading', "company")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----COURSE----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>COURSE
</p>

 @foreach($permission->where('permissionsheading', "course")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----skill----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>SKILL
</p>

 @foreach($permission->where('permissionsheading', "skill")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----DESIGNATION----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>DESIGNATION
</p>

 @foreach($permission->where('permissionsheading', "designation")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----TYPE----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>TYPE
</p>

 @foreach($permission->where('permissionsheading', "type")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



{{-----TAG----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>TAG
</p>

 @foreach($permission->where('permissionsheading', "tag")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach




{{-----ROLEJOB----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>ROLE JOB
</p>

 @foreach($permission->where('permissionsheading', "rolejob")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----jobnavlink----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>JOB NAV LINK
</p>

 @foreach($permission->where('permissionsheading', "jobnavlink")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach




{{-----POSTJOB----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>POST JOB
</p>

 @foreach($permission->where('permissionsheading', "postjob")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----BLOGPOST----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>BLOG POST
</p>

 @foreach($permission->where('permissionsheading', "postblog")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----CATEGORY BLOG----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>CATEGORY BLOG
</p>

 @foreach($permission->where('permissionsheading', "categoryblog")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----TAG BLOG----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>TAG BLOG
</p>

 @foreach($permission->where('permissionsheading', "tagblog")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----COMPETITIVE EXAM----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>COMPETITIVE EXAM
</p>

 @foreach($permission->where('permissionsheading', "competitiveexam")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----MARQUEE----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>MARQUEE
</p>

 @foreach($permission->where('permissionsheading', "marquee")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



{{-----ENQUIRY----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>ENQUIRY
</p>

 @foreach($permission->where('permissionsheading', "enquiry")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----SUBSCRIBE----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>SUBSCRIBE
</p>

 @foreach($permission->where('permissionsheading', "subscribe")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach




{{-----VIDEO POST----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>VIDEO POST
</p>

 @foreach($permission->where('permissionsheading', "postvideo")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----CATEGORY VIDEO----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>CATEGORY VIDEO
</p>

 @foreach($permission->where('permissionsheading', "categoryvideo")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----TAG VIDEO----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>TAG VIDEO
</p>

 @foreach($permission->where('permissionsheading', "tagvideo")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach






{{-----ROLE----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>ROLE
</p>

 @foreach($permission->where('permissionsheading', "role")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----ADDEMPLOYEE----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>ADD EMPLOYEE
</p>

 @foreach($permission->where('permissionsheading', "addemployee")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

{{-----SETTINGS----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>SETTINGS
</p>

 @foreach($permission->where('permissionsheading', "settings")->chunk(4) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


{{-----trackings----}}

  <p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>LOGININFO
</p>

 @foreach($permission->where('permissionsheading', "loginifo")->chunk(3) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="bg-success p-2 text-white rounded fs-5 mt-2">
   <i class="fas fa-list mr-3"></i>USER ACTIVITY
</p>

 @foreach($permission->where('permissionsheading', "useractivity")->chunk(3) as $chunk)
 <div class="d-flex flex-row m-4 fs-5 fw-bolder">
            @foreach($chunk as $value)
            <div class="col-md-3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach
