@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="JOB NAV LINK" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('jobnavlink.index') }}">Jobmiscellaneous</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('jobnavlink.index') }}">Jobnavlink</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ (!$jobnavlink->id) ? 'Create':  'Update'}} </li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.admincreateorupdate>
    <x-slot name="title">
       CREATE JOB NAV LINK
    </x-slot>


    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('jobnavlink.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="form">
    {!! Form::model($jobnavlink, ['route' => ['jobnavlink.store', $jobnavlink->id],  'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
    {{ Form::hidden('id', $jobnavlink->id, array('id' => 'invisible_id')) }}
    {{ Form::hidden('uniqid', $jobnavlink->uniqid, array('id' => 'invisible_id')) }}

    @include('admin.job.jobmiscellaneous.jobnavlink.form')

    <div class="text-center mt-3">
    @if ($jobnavlink->id)
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


<!-- shortname -->

<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 20;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#shortnametitleLeft').text('SHORT NAME ' +countTitle + ' characters left (Min:2,Max:20)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#shortname').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#shortnametitleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#shortnametitleLeft').text('SHORT NAME ' +countTitle + ' characters left (Min:2,Max:20)');
     }
   }

   /* on keyUp: update #shortnametitleLeft as well as count & commentTitle in localStorage */
   $('#shortname').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();

   });


 });
 </script>
<script>
  $("#jobnavlink-collapse").addClass('show');
  $("#jobnavlink").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#jobmiscellaneous").css({"background-color": "#00c5d0"});
</script>

@endsection
