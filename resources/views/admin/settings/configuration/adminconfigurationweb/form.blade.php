@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-4">

        @include('helper.formlabel', ['id'=>'', 'for' => "name", 'name' => "COMPANY NAME", 'required' => true])
        {{ Form::text('name', $adminconfigurationweb->name, ['id' => 'name', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "name"])
    </div>



    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "website", 'name' => "WEBSITE", 'required' => true])
        {{ Form::text('website', $adminconfigurationweb->website, ['id' => 'website', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "website"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "uplode_logo_image", 'name' => "UPLOAD LOGO", 'required' =>
        false])
        <input type="file" name="uplode_logo_image" accept="image/*" id="uplode_logo_image" class="form-control">
        <span> {{ $adminconfigurationweb->uplode_logo_image }} </span>
        @include('helper.formerror', ['error' => "uplode_logo_image"])
    </div>


    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "favicon_image", 'name' => "FAVICON IMAGE", 'required' =>
        false])
        <input type="file" name="favicon_image" accept="image/*" id="favicon_image" class="form-control">
        <span> {{ $adminconfigurationweb->favicon_image }} </span>
        @include('helper.formerror', ['error' => "favicon_image"])
    </div>


    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "timezone", 'name' => "TIME ZONE", 'required' => false])

        {{ Form::text('timezone', $adminconfigurationweb->timezone, ['id' => 'timezone', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "timezone"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "dateformate", 'name' => "DATE FORMATE", 'required' => false])

        {{ Form::text('dateformate', $adminconfigurationweb->dateformate, ['id' => 'dateformate', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "dateformate"])

    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "theme_color", 'name' => "THEME COLOR", 'required' => true])
        {{ Form::select('theme_color', $themecolor, $adminconfigurationweb->theme_color, ['class' => 'form-select', 'readonly' => 'true']) }}
        @include('helper.formerror', ['error' => "theme_color"])
    </div>



    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "text_color", 'name' => "TEXT COLOR", 'required' => true])

        {{ Form::select('text_color', $textcolor, $adminconfigurationweb->text_color, ['class' => 'form-select', 'readonly' => 'true']) }}
        @include('helper.formerror', ['error' => "text_color"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "background_color", 'name' => "BACKGROUND COLOR", 'required' =>
        true])

        {{ Form::select('background_color', $themecolor, $adminconfigurationweb->background_color, ['class' => 'form-select', 'readonly' => 'true']) }}
        @include('helper.formerror', ['error' => "background_color"])

    </div>



    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "headerbg_color", 'name' => "HEADER BG COLOR", 'required' =>
        true])

        {{ Form::select('headerbg_color', $themecolor, $adminconfigurationweb->headerbg_color, ['class' => 'form-select', 'readonly' => 'true']) }}
        @include('helper.formerror', ['error' => "headerbg_color"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "headertext_color", 'name' => "HEADER TEXT COLOR", 'required'
        => true])
        {{ Form::select('headertext_color', $textcolor, $adminconfigurationweb->headertext_color, ['class' => 'form-select', 'readonly' => 'true']) }}
        @include('helper.formerror', ['error' => "headertext_color"])

    </div>



    <!-- <div class="col-md-4">
      @include('helper.formlabel', ['id'=>'', 'for' => "footerbg_color", 'name' => "FOOTER BG COLOR", 'required' => true])

      {{ Form::select('footerbg_color', $themecolor, $adminconfigurationweb->footerbg_color, ['class' => 'form-select', 'readonly' => 'true']) }}
       @include('helper.formerror', ['error' => "footerbg_color"])
    </div> -->

    <!-- <div class="col-md-4">
      @include('helper.formlabel', ['id'=>'', 'for' => "footertext_color", 'name' => "FOOTER TEXT COLOR", 'required' => true])

      {{ Form::select('footertext_color', $textcolor, $adminconfigurationweb->footertext_color, ['class' => 'form-select', 'readonly' => 'true']) }}
       @include('helper.formerror', ['error' => "footertext_color"])

</div> -->

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "blogtemplates", 'name' => "BLOG TEMPLATE", 'required' =>
        false])

        {{ Form::select('blogtemplates', ['TEMPLATE ONE', 'TEMPLATE TWO'], $adminconfigurationweb->blogtemplates, ['class' => 'form-select p-1']) }}
        @include('helper.formerror', ['error' => "blogtemplates"])
    </div>


    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "copyrights", 'name' => "COPY RIGHTS", 'required' => false])
        {{ Form::text('copyrights', $adminconfigurationweb->copyrights, ['id' => 'copyrights', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "copyrights"])

    </div>



    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARKS", 'required' => false])

        {{ Form::textarea('remarks', $adminconfigurationweb->remarks, ['id' => '', 'class' => 'form-control', 'rows' => '2']) }}
        @include('helper.formerror', ['error' => "remarks"])

    </div>


</div>



<!-- ADDRESS DETAILS -->



<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> ADDRES DETAILS
</p>



<div class="row">
    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "address_one", 'name' => "ADDRESS LINE ONE", 'required' =>
        false])

        {{ Form::text('address_one', $adminconfigurationweb->address_one, ['id' => 'address_one', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "address_one"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "address_two", 'name' => "ADDRESS LINE TWO", 'required' =>
        false])

        {{ Form::text('address_two', $adminconfigurationweb->address_two, ['id' => 'address_two', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "address_two"])

    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "address_three", 'name' => "ADDRESS LINE THREE", 'required' =>
        false])

        {{ Form::text('address_three', $adminconfigurationweb->address_three, ['id' => 'address_three', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "address_three"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "phone1", 'name' => "PHONE NUMBER ONE", 'required' => false])

        {{ Form::text('phone1', $adminconfigurationweb->phone1, ['id' => 'phone1', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "phone1"])

    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "phone2", 'name' => "PHONE NUMBER TWO", 'required' => false])

        {{ Form::text('phone2', $adminconfigurationweb->phone2, ['id' => 'phone2', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "phone2"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "email", 'name' => "EMAIL", 'required' => false])

        {{ Form::text('email', $adminconfigurationweb->email, ['id' => 'email', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "email"])

    </div>
</div>


<!-- BANK DETAILS -->



<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> BANK DETAILS
</p>



<div class="row">
    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "bank_accountname", 'name' => "NAME", 'required' => false])

        {{ Form::text('bank_accountname', $adminconfigurationweb->bank_accountname, ['id' => 'bank_accountname', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "bank_accountname"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "bank_name", 'name' => "BANK NAME", 'required' => false])

        {{ Form::text('bank_name', $adminconfigurationweb->bank_name, ['id' => 'bank_name', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "bank_name"])

    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "account_number", 'name' => "ACCOUNT NUMBER", 'required' =>
        false])

        {{ Form::text('account_number', $adminconfigurationweb->account_number, ['id' => 'account_number', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "account_number"])
    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "ifsc_code", 'name' => "IFSC", 'required' => false])

        {{ Form::text('ifsc_code', $adminconfigurationweb->ifsc_code, ['id' => 'ifsc_code', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "ifsc_code"])

    </div>

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "branch", 'name' => "BRANCH", 'required' => false])

        {{ Form::text('branch', $adminconfigurationweb->branch, ['id' => 'branch', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "branch"])
    </div>


</div>



<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> SOCIAL MEDIA LINK
</p>
<div class="row">
    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "facebook", 'name' => "FACEBOOK URL", 'required' => false])

        {{ Form::text('facebook', $adminconfigurationweb->facebook, ['id' => 'facebook', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "facebook"])
    </div>
    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "twitter", 'name' => "TWITTER URL", 'required' => false])
        {{ Form::text('twitter', $adminconfigurationweb->twitter, ['id' => 'twitter', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "twitter"])

    </div>




    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "instagram", 'name' => "INSTAGRAM URL", 'required' => false])

        {{ Form::text('instagram', $adminconfigurationweb->instagram, ['id' => 'instagram', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "instagram"])
    </div>
    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "linkedin", 'name' => "LINKED IN URL", 'required' => false])

        {{ Form::text('linkedin', $adminconfigurationweb->linkedin, ['id' => 'linkedin', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "linkedin"])

    </div>

    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "youtube", 'name' => "YOUTUBE URL", 'required' => false])
        {{ Form::text('youtube', $adminconfigurationweb->youtube, ['id' => 'youtube', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "youtube"])
    </div>


    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "quora", 'name' => "QUORA URL", 'required' => false])
        {{ Form::text('quora', $adminconfigurationweb->quora, ['id' => 'quora', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "quora"])
    </div>

    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "medium", 'name' => "MEDIUM URL", 'required' => false])
        {{ Form::text('medium', $adminconfigurationweb->medium, ['id' => 'medium', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "medium"])
    </div>


    <div class="col-md-6">
        @include('helper.formlabel', ['id'=>'', 'for' => "reddit", 'name' => "REDDIT URL", 'required' => false])
        {{ Form::text('reddit', $adminconfigurationweb->reddit, ['id' => 'reddit', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "reddit"])
    </div>






</div>




<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> API KEY SETTINGS
</p>

<div class="row">



    <div class="col-md-3">
        @include('helper.formlabel', ['id'=>'', 'for' => "disqusflag", 'name' => "BLOG COMMENT STATUS", 'required' =>
        false])

        {{ Form::select('disqusflag', ['DISABLE', 'ENABLE'], $adminconfigurationweb->disqusflag, ['id' => 'disqusflag', 'class' => 'form-select']) }}
        @include('helper.formerror', ['error' => "disqusflag"])
    </div>
    <div class="col-md-9">
        @include('helper.formlabel', ['id'=>'', 'for' => "disquscode", 'name' => "DISQUS COMMENT CODE", 'required' =>
        false])

        {{ Form::text('disquscode', $adminconfigurationweb->disquscode, ['id' => 'disquscode', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "disquscode"])

    </div>


    <div class="col-md-3">
        @include('helper.formlabel', ['id'=>'', 'for' => "googleanalyticsapi", 'name' => "GOOGLE ANALYTICS API",
        'required' => false])

        {{ Form::text('googleanalyticsapi', $adminconfigurationweb->googleanalyticsapi, ['id' => 'googleanalyticsapi', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "googleanalyticsapi"])
    </div>
    <div class="col-md-9">
        @include('helper.formlabel', ['id'=>'', 'for' => "googleanalyticscode", 'name' => "GOOGLE ANALYTICS CODE",
        'required' =>
        false])
        {{ Form::text('googleanalyticscode', $adminconfigurationweb->googleanalyticscode, ['id' => 'googleanalyticscode', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "googleanalyticscode"])

    </div>
</div>






<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> SOCAIAL MEDIAL SHARE LINK SOURCE CODE
</p>
<div class="row">
    <div class="col-md-12">
        @include('helper.formlabel', ['id'=>'', 'for' => "socialmediaicon", 'name' => "VERTICAL SCRIPT CODE", 'required'
        => false])

        {{ Form::text('socialmediaicon', $adminconfigurationweb->socialmediaicon, ['id' => 'socialmediaicon', 'class' => 'form-control']) }}
        @include('helper.formerror', ['error' => "socialmediaicon"])

    </div>
</div>
