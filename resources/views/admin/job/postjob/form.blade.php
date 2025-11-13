<div class="col-md-2">
    {!! Form::checkbox('active', null, isset($postjob) ? $postjob->active : 0, ['id' => 'is_active', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_active", 'name' => "ACTIVE", 'required' => false])
    @include('helper.formerror', ['error' => "active"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_popular', null, isset($postjob) ? $postjob->is_popular : 0, ['id' => 'is_popular', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_popular", 'name' => "POPULAR", 'required' => false])
    @include('helper.formerror', ['error' => "is_popular"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('is_top', null, isset($postjob) ? $postjob->is_top : 0, ['id' => 'is_top', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "is_top", 'name' => "TOP JOBS", 'required' => false])
    @include('helper.formerror', ['error' => "is_top"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('video_status', null, isset($postjob) ? $postjob->video_status : 0, ['id' => 'video_status', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "video_status", 'name' => "VIDEO STATUS", 'required' => false])
    @include('helper.formerror', ['error' => "video_status"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('image_status', null, isset($postjob) ? $postjob->image_status : 0, ['id' => 'image_status', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "image_status", 'name' => "IMAGE STATUS", 'required' => false])
    @include('helper.formerror', ['error' => "image_status"])
</div>
<div class="col-md-2">
    {!! Form::checkbox('jobcomment', null, isset($postjob) ? $postjob->jobcomment : 0, ['id' => 'jobcomment', 'class' => 'form-check-input']) !!}
    @include('helper.formlabel', ['id'=>'', 'for' => "jobcomment", 'name' => "JOB COMMENT", 'required' => false])
    @include('helper.formerror', ['error' => "jobcomment"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'titleLeft', 'for' => "title", 'name' => "TITLE", 'required' => true])
    {{ Form::text('title', $postjob->name, ['id' => 'title', 'maxlength' => 80, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "title"])
</div>
{{-- <div class="col-md-12">
    @include('helper.formlabel', ['id'=>'subtitleLeft', 'for' => "subtitle", 'name' => "SUB TITLE", 'required' => true])
    {{ Form::text('subtitle', $postjob->subtitle, ['id' => 'subtitle', 'maxlength' => 100, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "subtitle"])
</div> --}}

<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'slugtitleLeft', 'for' => "slug", 'name' => "SLUG", 'required' => true])
    {{ Form::text('slug', $postjob->slug, ['id' => 'slug', 'maxlength' => 100, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "slug"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'keywordtitleLeft', 'for' => "seo_keyword", 'name' => "SEO KEYWORD", 'required'
    => true])
    {{ Form::text('seo_keyword', $postjob->seo_keyword, ['id' => 'seo_keyword', 'maxlength' => 255, 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "seo_keyword"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'descriptiontitleLeft', 'for' => "seo_description", 'name' => "SEO DESCRIPTION",
    'required' => true])
    {{ Form::textarea('seo_description', $postjob->seo_description, ['id' => 'seo_description', 'maxlength' => 165, 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "seo_description"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'responsibility', 'for' => "responsibility", 'name' => "RESPONSIBILITY",
    'required' => false])
    {{ Form::text('responsibility', $postjob->responsibility, ['id' => 'responsibility', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "responsibility"])
</div>

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "image", 'name' => "IMAGE", 'required' => false])
    <input type="file" name="image" accept="image/*" id="image" class="form-control">
    <span> {{ $postjob->image }} </span>
    @include('helper.formerror', ['error' => "image"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "image_alttag", 'name' => "IMAGE ALT", 'required'
    => false])
    {{ Form::text('image_alttag', $postjob->image_alttag, ['id' => 'image_alttag', 'maxlength' => '20', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "image_alttag"])
</div>

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "video_link", 'name' => "VIDEO LINK", 'required' => false])
    {{ Form::text('video_link', $postjob->video_link, ['id' => 'video_link', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "video_link"])
</div>
{{-- ----------JOB MASTERS---------- --}}
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "categoryoption", 'name' => "CATEGORY", 'required' => false])
    <select name="category_select[]" style="width:100%;" id="categoryoption" value="{{ $postjob->categorySelect }}"
        class="form-control input-lg dynamic js-example-basic-multiple" multiple="multiple">
        <option value="">Select Category</option>
    </select>
    @include('helper.formerror', ['error' => "category_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "courseoption", 'name' => "COURSE (EDUCATION)", 'required' =>
    false])
    <select name="course_select[]" id="courseoption" style="width:100%;" value="{{ $postjob->courseSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select course</option>
    </select>
    @include('helper.formerror', ['error' => "course_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "branchoption", 'name' => "BRANCH", 'required' => false])
    <select name="branch_select[]" id="branchoption" style="width:100%;" value="{{ $postjob->branchSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select Branch</option>
    </select>
    @include('helper.formerror', ['error' => "branch_select"])
</div>
<div class="col-md-6 ">
    @include('helper.formlabel', ['id'=>'', 'for' => "companyjob_id", 'name' => "COMPANY", 'required' => false])
    {{ Form::select('companyjob_id', $companyjob, $postjob->companyjob_id, ['id' => 'companyjob_id', 'class' => 'form-select js-example-basic-single', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "companyjob_id"])
</div>

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "skilloption", 'name' => "SKILL", 'required' => false])
    <select name="skill_select[]" id="skilloption" style="width:100%;" value="{{ $postjob->skillSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select Skill</option>
    </select>
    @include('helper.formerror', ['error' => "skill_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "languageoption", 'name' => "LANGUAGE", 'required' => false])
    <select name="language_select[]" id="languageoption" style="width:100%;" value="{{ $postjob->languageSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select language</option>
    </select>
    @include('helper.formerror', ['error' => "language_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "typeoption", 'name' => "TYPE", 'required' => false])
    <select name="type_select[]" id="typeoption" style="width:100%;" value="{{ $postjob->typeSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select Type</option>
    </select>
    @include('helper.formerror', ['error' => "type_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "designationoption", 'name' => "DESIGNATION", 'required' => false])
    <select name="designation_select[]" id="designationoption" style="width:100%;"
        value="{{ $postjob->designationSelect }}" class="form-control input-lg dynamic  js-example-basic-multiple"
        multiple="multiple">
        <option value="">Select Designation</option>
    </select>
    @include('helper.formerror', ['error' => "designation_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "rolesoption", 'name' => "ROLE", 'required' => false])
    <select name="roles_select[]" id="rolesoption" style="width:100%;" value="{{ $postjob->roleSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select Role</option>
    </select>
    @include('helper.formerror', ['error' => "roles_select"])
</div>
<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "tagoption", 'name' => "TAG", 'required' => false])
    <select name="tag_select[]" id="tagoption" style="width:100%;" value="{{ $postjob->tagSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select tag</option>
    </select>
    @include('helper.formerror', ['error' => "tag_select"])
</div>
{{-- -----------JOB MASTERS END---------- --}}


{{-- -------------COMPETITIVE EXAM------------- --}}

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "competitiveexamoption", 'name' => "COMPETITIVE EXAM", 'required'
    => false])
    <select name="competitiveexam_select[]" id="competitiveexamoption" style="width:100%;"
        value="{{ $postjob->competitiveexamSelect }}"
        class="form-control input-lg dynamic  js-example-basic-multiple" multiple="multiple">
        <option value="">Select competitiveexam</option>
    </select>
    @include('helper.formerror', ['error' => "competitiveexam_select"])
</div>


<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "sector", 'name' => "SECTOR", 'required' => false])
    <select name="sector" id="sector" class="form-select" readonly>
        @foreach (config('archive.sector') as $key => $value)
            <option value={{ $key }} {{ $postjob->sector == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @include('helper.formerror', ['error' => "sector"])
</div>

<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "total_vacancy", 'name' => "TOTAL VACANCY", 'required' => false])
    {{ Form::text('total_vacancy', $postjob->total_vacancy, ['id' => 'total_vacancy', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "total_vacancy"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "salarytype", 'name' => "SALARY TYPE", 'required' => false])
    <select name="salarytype" id="salarytype" class="form-select" readonly>
        @foreach (config('archive.salarytype') as $key => $value)
            <option value={{ $key }} {{ $postjob->salarytype == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @include('helper.formerror', ['error' => "salarytype"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "min_sal", 'name' => "MIN SALARY", 'required' => false])
    {{ Form::text('min_sal', $postjob->min_sal, ['id' => 'min_sal', 'class' => 'form-control ']) }}
    @include('helper.formerror', ['error' => "min_sal"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "max_sal", 'name' => "MAX SALARY", 'required' => false])
    {{ Form::text('max_sal', $postjob->max_sal, ['id' => 'max_sal', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "max_sal"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "min_exp", 'name' => "MIN EXPERIENCE", 'required' => false])
    {{ Form::text('min_exp', $postjob->min_exp, ['id' => 'min_exp', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "min_exp"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "max_exp", 'name' => "MAX EXPERIENCE", 'required' => false])
    {{ Form::text('max_exp', $postjob->max_exp, ['id' => 'max_exp', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "max_exp"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "min_age", 'name' => "MIN AGE", 'required' => false])
    {{ Form::text('min_age', $postjob->min_age, ['id' => 'min_age', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "min_age"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "max_age", 'name' => "MAX AGE", 'required' => false])
    {{ Form::text('max_age', $postjob->max_age, ['id' => 'max_age', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "max_age"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "workhours", 'name' => "WORK HOURS", 'required' => false])
    {{ Form::text('workhours', $postjob->workhours, ['id' => 'workhours', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "workhours"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "position", 'name' => "POSITION", 'required' => false])
    {{ Form::text('position', $postjob->position, ['id' => 'position', 'class' => 'form-control', 'readonly' => 'readonly']) }}
    @include('helper.formerror', ['error' => "position"])
</div>
{{-- --DATE---- --}}
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "postdate", 'name' => "JOB POST DATE", 'required' => false])
    <input type="date" name="postdate" placeholder="dd/mm/yyyy" class="form-control" value={{ $postjob->postdate }}>
    @include('helper.formerror', ['error' => "postdate"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "documentsubmissiondate", 'name' => "SUBMISSION DATE", 'required'
    => false])
    <input type="date" name="documentsubmissiondate" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->documentsubmissiondate }}>
    @include('helper.formerror', ['error' => "documentsubmissiondate"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "startdateapply", 'name' => "START DATE APPLY", 'required' =>
    false])
    <input type="date" name="startdateapply" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->startdateapply }}>
    @include('helper.formerror', ['error' => "startdateapply"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "lastdateapply", 'name' => "LAST DATE APPLY", 'required' => false])
    <input type="date" name="lastdateapply" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->lastdateapply }}>
    @include('helper.formerror', ['error' => "lastdateapply"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "examdate", 'name' => "EXAM DATE", 'required' => false])
    <input type="date" name="examdate" placeholder="dd/mm/yyyy" class="form-control" value={{ $postjob->examdate }}>
    @include('helper.formerror', ['error' => "examdate"])
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "extendeddateapply", 'name' => "EXTENDED DATE APPLY", 'required' =>
    false])
    <input type="date" name="extendeddateapply" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->extendeddateapply }}>
    @include('helper.formerror', ['error' => "extendeddateapply"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "interviewdate", 'name' => "INTERVIEW DATE", 'required' => false])
    <input type="date" name="interviewdate" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->interviewdate }}>
    @include('helper.formerror', ['error' => "interviewdate"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "finalresultdate", 'name' => "FINAL RESULT DATE", 'required' =>
    false])
    <input type="date" name="finalresultdate" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->finalresultdate }}>
    @include('helper.formerror', ['error' => "finalresultdate"])
</div>
<div class="col-md-2">
    @include('helper.formlabel', ['id'=>'', 'for' => "dateofjoining", 'name' => "DATE OF JOINING", 'required' => false])
    <input type="date" name="dateofjoining" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->dateofjoining }}>
    @include('helper.formerror', ['error' => "dateofjoining"])
</div>
{{-- --DATE END---- --}}
{{-- --COUNTRY AND STATES AND CITIES----------- --}}
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "country_id", 'name' => "SELECT COUNTRY", 'required' => false])
    {{ Form::select('country_id', $countries, $postjob->country_id, ['id' => 'country_id', 'class' => 'form-select js-example-basic-single', 'readonly' => 'readonly']) }}
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

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "streetaddress", 'name' => "STREET ADDRESS", 'required' => false])
    {{ Form::text('streetaddress', $postjob->streetaddress, ['id' => 'streetaddress', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "streetaddress"])
</div>
<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "postcode", 'name' => "POSTAL CODE", 'required' => false])
    {{ Form::text('postcode', $postjob->postcode, ['id' => 'postcode', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "postcode"])
</div>


<div class="col-md-3">
    @include('helper.formlabel', ['id'=>'', 'for' => "posted_on", 'name' => "POSTED ON", 'required' => false])
    <input type="date" name="posted_on" placeholder="dd/mm/yyyy" class="form-control"
        value={{ $postjob->posted_on }}>
    @include('helper.formerror', ['error' => "posted_on"])
</div>

<div class="col-md-6">
    @include('helper.formlabel', ['id'=>'', 'for' => "jobid", 'name' => "JOB ID", 'required' => false])
    {{ Form::text('jobid', $postjob->jobid, ['id' => 'jobid', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "jobid"])
</div>
{{-- --------NOTIFICATION LINK ------------ --}}
@livewire('admin.post.notification', ['postjobid' => $postjob->id])
{{-- ------------SHORT DESCRIPTION----------- --}}
{{-- <div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "short_description", 'name' => "SHORT DESCRIPTION", 'required' =>
    true])
    {{ Form::textarea('short_description', $postjob->short_description, ['id' => 'short_description', 'class' => 'form-control short_description ']) }}
    @include('helper.formerror', ['error' => "short_description"])
</div> --}}
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "body", 'name' => "BODY", 'required' => true])
    {{ Form::textarea('body', $postjob->body, ['id' => 'body', 'class' => 'form-control body ']) }}
    @include('helper.formerror', ['error' => "body"])
</div>
<div class="col-md-12">
    @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARK", 'required' => false])
    {{ Form::textarea('remarks', $postjob->remarks, ['id' => 'remarks', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "remarks"])
</div>
