@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="TAG" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('tagjob.index') }}">Master</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('tagjob.index') }}">Tag</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ (!$tagjob->id) ? 'Create':  'Update'}} </li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.admincreateorupdate>
    <x-slot name="title">
       CREATE TAG
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('tagjob.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="form">
    {!! Form::model($tagjob, ['route' => ['tagjob.store', $tagjob->id],  'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
    {{ Form::hidden('id', $tagjob->id, array('id' => 'invisible_id')) }}
    {{ Form::hidden('uniqid', $tagjob->uniqid, array('id' => 'invisible_id')) }}

    @include('admin.job.jobmaster.tagjob.form')

    <div class="text-center mt-3">
    @if ($tagjob->id)
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
<!-- TITLE CHARACTER -->

<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 35;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#titleLeft').text('TITLE ' +countTitle + ' characters left (Min:5,Max:35)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#tag').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#titleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#titleLeft').text('TITLE ' +countTitle + ' characters left (Min:5,Max:35)');
     }
   }

   /* on keyUp: update #titleLeft as well as count & commentTitle in localStorage */
   $('#tag').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();

   });


 });
 </script>















<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 80;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#slugtitleLeft').text('SLUG ' +countTitle + ' characters left (Min:10,Max:80)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#slug').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#slugtitleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#slugtitleLeft').text('SLUG ' +countTitle + ' characters left (Min:10,Max:80)');
     }
   }

   /* on keyUp: update #slugtitleLeft as well as count & commentTitle in localStorage */
   $('#slug').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();

   });


 });
 </script>



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


<!-- keyword -->

<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 150;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#keywordtitleLeft').text('SEO KEYWORD ' +countTitle + ' characters left (Min:25,Max:150)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#keyword').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#keywordtitleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#keywordtitleLeft').text('SEO KEYWORD ' +countTitle + ' characters left (Min:25,Max:150)');
     }
   }

   /* on keyUp: update #keywordtitleLeft as well as count & commentTitle in localStorage */
   $('#keyword').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();
   });


 });
 </script>



<!-- DESCRIPTION -->
<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 200;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#descriptiontitleLeft').text('SEO DESCRIPTION ' +countTitle + ' characters left (Min:30,Max:200)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#description').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#descriptiontitleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#descriptiontitleLeft').text('SEO DESCRIPTION  ' +countTitle + ' characters left (Min:30,Max:200)');
     }
   }

   /* on keyUp: update #descriptiontitleLeft as well as count & commentTitle in localStorage */
   $('#description').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();
   });

 });
 </script>

<script>
  $("#jobmaster-collapse").addClass('show');
  $("#tagjob").css({"background-color": "#00c5d0"});
  $("#jobmaster").css({"background-color": "#00c5d0"});
</script>
@endsection
