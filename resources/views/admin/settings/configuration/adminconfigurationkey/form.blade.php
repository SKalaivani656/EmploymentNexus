@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



    <!-- MAIL CREDENTIALS -->


    <p class="bg-success p-2 text-white rounded fs-5 mt-2">
        <i class="fas fa-list mr-3"></i> MAIL CREDENTIALS
    </p>



    <div class="row">

    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "email_from_name", 'name' => "FROM NAME", 'required' => false])

        {{ Form::text('email_from_name',$adminconfigurationkey->email_from_name ,array('id'=>'email_from_name', 'class'=>'form-control')) }}
        @include('helper.formerror', ['error' => "email_from_name"])
    </div>
    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "email_from_mail", 'name' => "FROM EMAIL", 'required' => false])

        {{ Form::text('email_from_mail',$adminconfigurationkey->email_from_mail ,array('id'=>'email_from_mail', 'class'=>'form-control')) }}
        @include('helper.formerror', ['error' => "email_from_mail"])

    </div>


    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "email_mail_driver", 'name' => "MAIL DRIVER", 'required' => false])

        {{ Form::text('email_mail_driver',$adminconfigurationkey->email_mail_driver ,array('id'=>'email_mail_driver', 'class'=>'form-control')) }}
        @include('helper.formerror', ['error' => "email_mail_driver"])
    </div>
    <div class="col-md-4">
        @include('helper.formlabel', ['id'=>'', 'for' => "email_mail_host", 'name' => "MAIL HOST", 'required' => false])

        {{ Form::text('email_mail_host',$adminconfigurationkey->email_mail_host ,array('id'=>'email_mail_host', 'class'=>'form-control')) }}
        @include('helper.formerror', ['error' => "email_mail_host"])
    </div>



<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "email_mail_port", 'name' => "MAIL PORT", 'required' => false])

    {{ Form::text('email_mail_port',$adminconfigurationkey->email_mail_port ,array('id'=>'email_mail_port', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "email_mail_port"])
</div>
<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "email_mail_username", 'name' => "MAIL USERNAME", 'required' => false])
    {{ Form::text('email_mail_username',$adminconfigurationkey->email_mail_username ,array('id'=>'email_mail_username', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "email_mail_username"])

</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "email_mail_password", 'name' => "MAIL PASSWORD", 'required' => false])

    {{ Form::text('email_mail_password',$adminconfigurationkey->email_mail_password ,array('id'=>'email_mail_password', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "email_mail_password"])
</div>
<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "email_mail_encryption", 'name' => "MAIL ENCRYPTION", 'required' => false])

    {{ Form::text('email_mail_encryption',$adminconfigurationkey->email_mail_encryption ,array('id'=>'email_mail_encryption', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "email_mail_encryption"])

</div>
</div>



<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> API KEY SETTINGS
</p>

<div class="row">
<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "mailchimpflag", 'name' => "MAILCHIMP STATUS", 'required' => false])

    {{ Form::select('mailchimpflag', ['DISABLE', 'ENABLE'], $adminconfigurationkey->mailchimpflag, ['class' => 'form-select']) }}
    @include('helper.formerror', ['error' => "mailchimpflag"])
</div>
<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "mailchimpapikey", 'name' => "MAILCHIMP API KEY", 'required' => false])

    {{ Form::text('mailchimpapikey',$adminconfigurationkey->mailchimpapikey ,array('id'=>'mailchimpapikey', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "mailchimpapikey"])

</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "mailchimplistid", 'name' => "MAILCHIMP LIST ID", 'required' => false])

    {{ Form::text('mailchimplistid',$adminconfigurationkey->mailchimplistid ,array('id'=>'mailchimplistid', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "mailchimplistid"])

</div>
</div>

<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> BLOG SEARCH
</p>



<div class="row">
<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "searchstatus", 'name' => "SEARCH STATUS", 'required' => false])

    {{ Form::select('searchstatus', ['DISABLE', 'ENABLE', 'AGOLIA SEARCH'], $adminconfigurationkey->searchstatus, ['class' => 'form-select rounded block w-full focus:bg-white  p-1']) }}
    @include('helper.formerror', ['error' => "searchstatus"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "algoliaapp", 'name' => "ALGOLIA APP ID", 'required' => false])

    {{ Form::text('algoliaapp',$adminconfigurationkey->algoliaapp ,array('id'=>'algoliaapp', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "algoliaapp"])

</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "algoliasecret", 'name' => "ALGOLIA SECRET", 'required' => false])

    {{ Form::text('algoliasecret',$adminconfigurationkey->algoliasecret ,array('id'=>'algoliasecret', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "algoliasecret"])

</div>
</div>

<p class="bg-success p-2 text-white rounded fs-5 mt-2">
    <i class="fas fa-list mr-3"></i> GOOGLE CAPTCHA
</p>



<div class="row">
<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "recaptchasecretstatus", 'name' => "CAPTCHA STATUS", 'required' => false])

    {{ Form::select('recaptchasecretstatus', ['DISABLE', 'ENABLE'], $adminconfigurationkey->recaptchasecretstatus, ['class' => 'form-select rounded block w-full focus:bg-white  p-1']) }}
    @include('helper.formerror', ['error' => "recaptchasecretstatus"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "recaptchasitekey", 'name' => "CAPTCHA SITE KEY", 'required' => false])

    {{ Form::text('recaptchasitekey',$adminconfigurationkey->recaptchasitekey ,array('id'=>'recaptchasitekey', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "recaptchasitekey"])

</div>


<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "recaptchasecretkey", 'name' => "CAPTCHA SECRET KEY", 'required' => false])

    {{ Form::text('recaptchasecretkey',$adminconfigurationkey->recaptchasecretkey ,array('id'=>'recaptchasecretkey', 'class'=>'form-control')) }}
    @include('helper.formerror', ['error' => "recaptchasecretkey"])

</div>

</div>

</div>
