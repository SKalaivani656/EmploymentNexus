@extends('components.admin.layouts.adminapp')
@section('headSection')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="VIDEO POST" />
@endsection

@section('main-content')

<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postvideo.index') }}">Video</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postvideo.index') }}">Video Post</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ (!$postvideo->id) ? 'Create':  'Update'}} </li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.admincreateorupdate>
    <x-slot name="title">
       CREATE VIDEO POST
    </x-slot>


    <x-slot name="action">
        <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('postvideo.index') }}" role="button">Back</a>
    </x-slot>

    <x-slot name="form">
    {!! Form::model($postvideo, ['route' => ['postvideo.store', $postvideo->id],  'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
    {{ Form::hidden('id', $postvideo->id, array('id' => 'invisible_id')) }}
    {{ Form::hidden('uniqid', $postvideo->uniqid, array('id' => 'invisible_id')) }}

    @include('admin.video.postvideo.form')

    <div class="text-center mt-3">
    @if ($postvideo->id)
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script type="text/javascript">






var Blockquoteone = function(context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
        contents: '<i class="fa fa-quote-left"/> Quote Simple',
        tooltip: 'hello',
        click: function() {
            // invoke insertText method with 'hello' on editor module.
            context.invoke('editor.pasteHTML', '<blockquote class="blockquote"><p>A well-known quote, contained in a blockquote element.</p></blockquote>');
        }
    });

    return button.render(); // return button as jquery object
}

var Blockquotetwo = function(context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
        contents: '<i class="fa fa-quote-left"/> Quote Left',
        tooltip: 'hello',
        click: function() {
            // invoke insertText method with 'hello' on editor module.
            context.invoke('editor.pasteHTML', '<figure><blockquote class=blockquote><p>A well-known quote, contained in a blockquote element.</blockquote><figcaption class=blockquote-footer>Someone famous in <cite title="Source Title">Source Title</cite></figcaption></figure>');
        }
    });

    return button.render(); // return button as jquery object
}


var Blockquotethree = function(context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
        contents: '<i class="fa fa-quote-left"/> Quote Center',
        tooltip: 'hello',
        click: function() {
            // invoke insertText method with 'hello' on editor module.
            context.invoke('editor.pasteHTML', '<figure class=text-center><blockquote class=blockquote><p>A well-known quote, contained in a blockquote element.</blockquote><figcaption class=blockquote-footer>Someone famous in <cite title="Source Title">Source Title</cite></figcaption></figure>');
        }
    });

    return button.render(); // return button as jquery object
}

var Blockquotefour = function(context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
        contents: '<i class="fa fa-quote-left"/> Quote End',
        tooltip: 'hello',
        click: function() {
            // invoke insertText method with 'hello' on editor module.
            context.invoke('editor.pasteHTML', '<figure class=text-end><blockquote class=blockquote><p>A well-known quote, contained in a blockquote element.</blockquote><figcaption class=blockquote-footer>Someone famous in <cite title="Source Title">Source Title</cite></figcaption></figure>');
        }
    });

    return button.render(); // return button as jquery object
}


$('.body').summernote({
    placeholder: 'Post Your Blog Here',
    tabsize: 2,
    height: 400,
    callbacks: {
            onMediaDelete : function(target) {
                // alert(target[0].src)
                deleteFile(target[0].src);
            }
        },
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['style', ['style']],
        ['fontname', ['fontname']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video', 'hr']],
        ['misc', ['undo', 'redo', 'print']],
        ['view', ['fullscreen', 'codeview', 'help']],
        ['mybutton', ['quotesone', 'quotestwo', 'quotesthree', 'quotesfour']],
    ],
    buttons: {
        quotesone: Blockquoteone,
        quotestwo   : Blockquotetwo,
        quotesthree   : Blockquotethree,
        quotesfour   : Blockquotefour,
    },
    popover: {
        image: [
            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']],
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        table: [
            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
        ],
        air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']]
        ],
    }
});




</script>



<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.js-example-basic-multiple').select2();

    ajaxvideocategory();

    function ajaxvideocategory() {
    $.ajax({
        url: "{{route('ajaxvideocategory')}}",
        mehtod: "get",
        dataType: 'json',
        success: function(data) {
            $('#categoryoption').html(data.categoryoption);
            $('#categoryoption').val({!! $postvideo->categoryvideoSelect !!});
            $('#categoryoption').trigger('change');

            $('#tagoption').html(data.tagoption);
            $('#tagoption').val({!! $postvideo->tagvideoSelect !!});
            $('#tagoption').trigger('change');

        }
    })
    }
});
</script>







<!-- TITLE CHARACTER -->

<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 80;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#titleLeft').text('TITLE ' +countTitle + ' characters left (Min:30,Max:80)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#title').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#titleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#titleLeft').text('TITLE ' +countTitle + ' characters left (Min:30,Max:80)');
     }
   }

   /* on keyUp: update #titleLeft as well as count & commentTitle in localStorage */
   $('#title').keyup(function() {
     checkCountTitle();
     commentTitle = $(this).val();

   });
 });
 </script>



<!-- SLUGTITLE CHARACTER -->

<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 80;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#slugtitleLeft').text('SLUG ' +countTitle + ' characters left (Min:20,Max:80)');

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
       $('#slugtitleLeft').text('SLUG ' +countTitle + ' characters left (Min:20,Max:80)');
     }
   }

   /* on keyUp: update #slugtitleLeft as well as count & commentTitle in localStorage */
   $('#slug').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();

   });


 });
 </script>


<!-- seo_keyword -->

<script type="text/javascript">
    /* TITLE:
  http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
 $( document ).ready(function() {
   var maxCharstitle = 150;
   var textLengthTitle = 0;
   var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

   /* initalize for when no data is in localStorage */
   var countTitle = maxCharstitle;
   $('#keywordtitleLeft').text('SEO KEYWORD ' +countTitle + ' characters left (Min:30,Max:150)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#seo_keyword').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#keywordtitleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#keywordtitleLeft').text('SEO KEYWORD ' +countTitle + ' characters left (Min:30,Max:150)');
     }
   }

   /* on keyUp: update #keywordtitleLeft as well as count & commentTitle in localStorage */
   $('#seo_keyword').keyup(function() {

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
   $('#descriptiontitleLeft').text('SEO DESCRIPTION ' +countTitle + ' characters left (Min:40,Max:200)');

   /* fix val so it counts carriage returns */
   $.valHooks.textarea = {
     get: function(e) {
       return e.value.replace(/\r?\n/g, "\r\n");
     }
   };

   function checkCountTitle() {
     textLengthTitle = $('#seo_description').val().length;
     if (textLengthTitle >= maxCharstitle) {
       $('#descriptiontitleLeft').text(outOfChars);
     }
     else {
       countTitle = maxCharstitle - textLengthTitle;
       $('#descriptiontitleLeft').text('SEO DESCRIPTION  ' +countTitle + ' characters left (Min:40,Max:200)');
     }
   }

   /* on keyUp: update #descriptiontitleLeft as well as count & commentTitle in localStorage */
   $('#seo_description').keyup(function() {

     checkCountTitle();
     commentTitle = $(this).val();
   });

 });
 </script>

<script>
  $("#video-collapse").addClass('show');
  $("#postvideo").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#video").css({"background-color": "#00c5d0"});
</script>

@endsection
