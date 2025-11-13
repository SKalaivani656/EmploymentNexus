@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="WEBSITE MARQUEE" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websitemarquee.index') }}">Website</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websitemarquee.index') }}">Marquee</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ (!$websitemarquee->id) ? 'Create':  'Update'}} </li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.admincreateorupdate>
    <x-slot name="title">
       CREATE MARQUEE
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('websitemarquee.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="form">
    {!! Form::model($websitemarquee, ['route' => ['websitemarquee.store', $websitemarquee->id],  'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
    {{ Form::hidden('id', $websitemarquee->id, array('id' => 'invisible_id')) }}
    {{ Form::hidden('uniqid', $websitemarquee->uniqid, array('id' => 'invisible_id')) }}

    @include('admin.website.websitemarquee.form')

    <div class="text-center mt-3">
    @if ($websitemarquee->id)
    {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> UPDATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits'] ) !!}
    @else
    {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> CREATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits'] ) !!}
    @endif
    <a href="" class="shadow btn  btn-sm btn-danger rounded">CANCEL</a>
    </div>

    {!! Form::close() !!}
</x-slot>

</x-admin.layouts.admincreateorupdate>


@endsection
@section('footerSection')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script type="text/javascript">

$('.marquee').summernote({
     placeholder: 'Short Description About Job',
     tabsize: 2,
     height: 100
   });
   
</script>

<script>
  $("#website-collapse").addClass('show');
  $("#websitemarquee").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#website").css({"background-color": "#00c5d0"});
</script>

@endsection
