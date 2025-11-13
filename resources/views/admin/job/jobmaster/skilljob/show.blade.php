@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SKILLS" />
@endsection

@section('main-content')

    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('skilljob.index') }}">Master</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('skilljob.index') }}">skill</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.adminshow>
        <x-slot name="title">
            SKILL DETAILS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('skilljob.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="label">
            @include('helper.showlabel', ['name' => "ACTIVE", 'value' => isset($skilljob) && ($skilljob->active== 0) ? 'NO'
            : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "TOP JOB", 'value' => isset($skilljob) && ($skilljob->is_top == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "POPULAR", 'value' => isset($skilljob) && ($skilljob->is_popular == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "FOOTER", 'value' => isset($skilljob) && ($skilljob->is_footer == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "LEFT SIDE MENU", 'value' => isset($skilljob) &&
            ($skilljob->is_leftsidemenu == 0) ? 'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4",
            'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "MOBILE", 'value' => isset($skilljob) && ($skilljob->is_mobile == 0) ?
            'NO' : 'YES' , 'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SKILL NAME", 'value' => $skilljob->name, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            <div class="row col-md-6">
             <label class="form-label fw-bold col-4">IMAGE:</label>
              <label class="form-label col-8">
              <img src="{{ asset('storage/images/skilljob/images/'.$skilljob->image) }}" style="width:100px; Height:60px;">
            </label>
           </div>

            @include('helper.showlabel', ['name' => "IMAGE ALT", 'value' =>$skilljob->image_alttag,
             'columnone' => "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "SLUG", 'value' => $skilljob->slug, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "KEYWORD", 'value' => $skilljob->seo_keyword, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "DESCRIPTION", 'value' => $skilljob->seo_description, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "REMARKS", 'value' => $skilljob->remarks, 'columnone' => "col-md-6",
            'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED AT", 'value' => $skilljob->created_at, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @include('helper.showlabel', ['name' => "CREATED BY", 'value' => $skilljob->created_by, 'columnone' =>
            "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @if ($skilljob->updated_by)
                @include('helper.showlabel', ['name' => "UPDATED AT", 'value' => $skilljob->updated_at, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
                @include('helper.showlabel', ['name' => "UPDATED BY", 'value' => $skilljob->updated_by, 'columnone' =>
                "col-md-6", 'columntwo' => "col-4", 'columnthree' => "col-8"])
            @endif
        </x-slot>

    </x-admin.layouts.adminshow>

@endsection
@section('footerSection')

<script>
  $("#jobmaster-collapse").addClass('show');
  $("#skilljob").css({"background-color": "#00c5d0"});
  $("#jobmaster").css({"background-color": "#00c5d0"});
</script>
@endsection
