@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="JOB POST" />
@endsection

@section('main-content')


    <x-admin.layouts.adminbreadcrumb>

        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('postjob.index') }}">Job Post</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ !$postjob->id ? 'Create' : 'Update' }} </li>
    </x-admin.layouts.adminbreadcrumb>

    <x-admin.layouts.admincreateorupdate>
        <x-slot name="title">
            CREATE POST
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end" href="{{ route('postjob.index') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="form">
            {!! Form::model($postjob, ['route' => ['postjob.store', $postjob->id], 'id' => '', 'class' => 'row g-3 form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
            {{ Form::hidden('id', $postjob->id, ['id' => 'invisible_id']) }}
            {{ Form::hidden('uniqid', $postjob->uniqid, ['id' => 'invisible_id']) }}

            @include('admin.job.postjob.form')

            <div class="text-center mt-3">
                @if ($postjob->id)
                    {!! Form::button('<i class="fa fa-spinner m-1 fa-spin"></i> UPDATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits']) !!}
                @else
                    {!! Form::button('<i class="fa fa-spinner m-1 fa-spin"></i> CREATE', ['type' => 'submit', 'class' => 'shadow btn btn-primary rounded button_prevent_multiple_submits']) !!}
                @endif
                <a href="" class="shadow btn  btn-sm btn-danger rounded">CANCEL</a>
            </div>

            {!! Form::close() !!}
        </x-slot>

    </x-admin.layouts.admincreateorupdate>


@endsection
@section('footerSection')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>


    <script type="text/javascript">
        $('.short_description').summernote({
            placeholder: 'Short Description About Job',
            tabsize: 2,
            height: 100
        });

        var Templateone = function(context) {
            var ui = $.summernote.ui;
            // create button
            var button = ui.button({
                contents: '<i class="fa fa-quote-left"/>Gover',
                tooltip: 'hello',
                click: function() {
                    // invoke insertText method with 'hello' on editor module.
                    context.invoke('editor.pasteHTML',
                        '<div> <h6 class="fw-bold">Vacancies & Eligibility Criteria:</h6> <div class=table-responsive> <table class="table table-bordered table-hover"> <thead> <tr> <th>Post</th> <th>Vacancy</th> <th>Age</th> <th>Qualification</th> <th>Pay</th> </tr></thead> <tbody> <tr> <td style="font-size:14px">31st Bihar Judicial Services Competitive (Judge Junior Level) Examination</td><td style="font-size:14px">221</td><td style="font-size:14px">22-35 yrs</td><td style="font-size:14px">Law Graduate</td><td style="font-size:14px">as per norms</td></tr></tbody> </table> </div><h6 class="fw-bold my-2" style="font-size:15px">Dates to Consider:</h6> <div style="font-size:14px">Starting date for registration of Online Application: 31-08-{{ date('Y') }}</div><div style="font-size:14px">Last date for payment of fee: 05-09-{{ date('Y') }}</div><div style="font-size:14px">Last date for final submission of Application: 12-09-{{ date('Y') }}</div><h6 class="fw-bold my-2" style="font-size:15px">Selection Process:</h6> <div style="font-size:14px">There will be a preliminary exam, main exam, and personal Interviews, for the selection of eligible candidates. </div><h6 class="fw-bold my-2" style="font-size:15px">Application Fee:</h6> <div style="font-size:14px">For General: Rs.600/- (SC/ST/PWD: Rs.150/-)To be paid online)</div><h6 class="fw-bold my-2" style="font-size:15px">Vacancies Details:</h6> <div class=table-responsive> <table class="table table-bordered table-hover"> <thead> <tr> <th>Post Name</th> <th>No of Vacancy</th> <th>Qualification</th> </tr></thead> <tbody> <tr> <td style="font-size:14px">----</td><td style="font-size:14px">00</td><td style="font-size:14px">---</td></tr></tbody> </table> </div><h6 class="fw-bold my-2" style="font-size:15px">Apply Mode:</h6> <div style="font-size:14px">Online/Offline/Email</div><h6 class="fw-bold my-2" style="font-size:15px">How To Apply:</h6> <div style="font-size:14px">Interested candidates with qualifications may apply online for concerned posts as per the given online application form.</div><div style="font-size:14px">Keeping a print copy for future use is advised.</div></div>'
                    );
                }
            });

            return button.render(); // return button as jquery object
        }

        var Templatetwo = function(context) {
            var ui = $.summernote.ui;
            // create button
            var button = ui.button({
                contents: '<i class="fa fa-quote-left"/>IT',
                tooltip: 'hello',
                click: function() {
                    // invoke insertText method with 'hello' on editor module.
                    context.invoke('editor.pasteHTML',
                        '<div> <h6 class="fw-bold">Vacancies & Eligibility Criteria:</h6> <div class=table-responsive> <table class="table table-bordered table-hover"> <thead> <tr> <th>Post</th> <th>Vacancy</th> <th>Age</th> <th>Qualification</th> <th>Pay</th> </tr></thead> <tbody> <tr> <td style="font-size:14px">31st Bihar Judicial Services Competitive (Judge Junior Level) Examination </td><td style="font-size:14px">221</td><td style="font-size:14px">22-35 yrs</td><td style="font-size:14px">Law Graduate</td><td style="font-size:14px">as per norms</td></tr></tbody> </table> </div><h6 class="fw-bold my-2" style="font-size:15px">Apply Mode:</h6> <div style="font-size:14px">Online/Offline/Email</div><h6 class="fw-bold my-2" style="font-size:15px">How To Apply:</h6> <div style="font-size:14px">Interested candidates with qualifications may apply online for concerned posts as per the given online application form.</div><div style="font-size:14px">Keeping a print copy for future use is advised.</div></div>'
                    );
                }
            });

            return button.render(); // return button as jquery object
        }








        var Templatethree = function(context) {
            var ui = $.summernote.ui;
            // create button
            var button = ui.button({
                contents: '<i class="fa fa-quote-left"/>Jumbotron',
                tooltip: 'hello',
                click: function() {
                    // invoke insertText method with 'hello' on editor module.
                    context.invoke('editor.pasteHTML',
                        '<div class="bg-light mb-2 p-3 rounded-3"><div class="container-fluid py-3"><h1 class="display-6 fw-bold">Custom jumbotron</h1><p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p></div>'
                    );
                }
            });

            return button.render(); // return button as jquery object
        }


        $('.body').summernote({
            placeholder: 'Post Your Jobs Here',
            tabsize: 2,
            height: 400,
            callbacks: {
                onMediaDelete: function(target) {
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
                ['mybutton', ['templateone', 'templatetwo', 'templatethree']],
            ],
            buttons: {
                templateone: Templateone,
                templatetwo: Templatetwo,
                templatethree: Templatethree,
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

        function deleteFile(src) {
            $.ajax({
                data: {
                    src: src
                },
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ URL('admin/jobcontentimagedel') }}", // replace with your url
                cache: false,
                success: function(resp) {
                    console.log(resp);
                }
            });
        }

    </script>

    <script>
        $(document).ready(function() {

            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();

            $(":input[data-inputmask-mask]").inputmask();
            $(":input[data-inputmask-alias]").inputmask();
            $(":input[data-inputmask-regex]").inputmask("Regex");

            $('#total_vacancy').mask('99999999');
            $('#min_sal').mask('99999999');
            $('#max_sal').mask('99999999');
            $('#min_exp').mask('99');
            $('#max_exp').mask('99');
            $('#min_age').mask('99');
            $('#max_age').mask('99');

            $('#agelimit').mask('99');
            $('#experience').mask('99');

            ajaxcategorylistjob();

            function ajaxcategorylistjob() {
                $.ajax({
                    url: "{{ route('ajaxcategorylistjob') }}",
                    mehtod: "get",
                    dataType: 'json',
                    success: function(data) {
                        $('#categoryoption').html(data.categoryoption);
                        $('#categoryoption').val({!! $postjob->categorySelect !!});
                        $('#categoryoption').trigger('change');

                        $('#tagoption').html(data.tagoption);
                        $('#tagoption').val({!! $postjob->tagSelect !!});
                        $('#tagoption').trigger('change');

                        $('#branchoption').html(data.branchoption);
                        $('#branchoption').val({!! $postjob->branchSelect !!});
                        $('#branchoption').trigger('change');


                        $('#courseoption').html(data.courseoption);
                        $('#courseoption').val({!! $postjob->courseSelect !!});
                        $('#courseoption').trigger('change');

                        $('#skilloption').html(data.skilloption);
                        $('#skilloption').val({!! $postjob->skillSelect !!});
                        $('#skilloption').trigger('change');

                        $('#languageoption').html(data.languageoption);
                        $('#languageoption').val({!! $postjob->languageSelect !!});
                        $('#languageoption').trigger('change');

                        $('#designationoption').html(data.designationoption);
                        $('#designationoption').val({!! $postjob->designationSelect !!});
                        $('#designationoption').trigger('change');



                        $('#typeoption').html(data.typeoption);
                        $('#typeoption').val({!! $postjob->typeSelect !!});
                        $('#typeoption').trigger('change');

                        $('#rolesoption').html(data.rolesoption);
                        $('#rolesoption').val({!! $postjob->roleSelect !!});
                        $('#rolesoption').trigger('change');

                        $('#competitiveexamoption').html(data.competitiveexamoption);
                        $('#competitiveexamoption').val({!! $postjob->competitiveexamSelect !!});
                        $('#competitiveexamoption').trigger('change');
                    }
                })
            }
        });

    </script>
    <script type="text/javascript">
        statekey = {!! json_encode($postjob->state_id) !!};
        statename = {!! json_encode($postjob->state) !!};
        $("#state_id").append('<option value="' + statekey + '">' + ((statename) ? statename : '') + '</option>');
        citykey = {!! json_encode($postjob->city_id) !!};
        cityname = {!! json_encode($postjob->city) !!};
        $("#city_id").append('<option value="' + citykey + '">' + ((cityname) ? cityname : '') + '</option>');

        $('#country_id').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getstatelist') }}?country_id=" + countryID,
                    success: function(res) {
                        if (res) {
                            $("#state_id").empty();
                            $("#city_id").empty();
                            $("#state_id").append('<option>Select</option>');
                            $.each(res, function(key, value) {
                                $("#state_id").append('<option value="' + key + '">' + value +
                                    '</option>');

                            });

                        } else {
                            $("#state_id").empty();
                            $("#city_id").empty();
                        }
                    }
                });
            } else {
                $("#state_id").empty();
                $("#city_id").empty();
            }
        });
        $('#state_id').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getcitylist') }}?state_id=" + stateID,
                    success: function(res) {
                        if (res) {
                            $("#city_id").empty();
                            $("#city_id").append('<option>Select</option>');
                            $.each(res, function(key, value) {
                                $("#city_id").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {
                            $("#city_id").empty();
                        }
                    }
                });
            } else {
                $("#city_id").empty();
            }

        });

    </script>


    <!-- TITLE CHARACTER -->

    <script type="text/javascript">
        /* TITLE:
                                                              http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
        $(document).ready(function() {
            var maxCharstitle = 80;
            var textLengthTitle = 0;
            var commentTitle = "";
            var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

            /* initalize for when no data is in localStorage */
            var countTitle = maxCharstitle;
            $('#titleLeft').text('TITLE ' + countTitle + ' characters left (Min:30,Max:80)');

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
                } else {
                    countTitle = maxCharstitle - textLengthTitle;
                    $('#titleLeft').text('TITLE ' + countTitle + ' characters left (Min:30,Max:80)');
                }
            }

            /* on keyUp: update #titleLeft as well as count & commentTitle in localStorage */
            $('#title').keyup(function() {
                checkCountTitle();
                commentTitle = $(this).val();
            });



        });

    </script>

    <!-- SUBTITLE CHARACTER -->

    <script type="text/javascript">
        /* TITLE:
                                                              http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
        $(document).ready(function() {
            var maxCharstitle = 100;
            var textLengthTitle = 0;
            var commentTitle = "";
            var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

            /* initalize for when no data is in localStorage */
            var countTitle = maxCharstitle;
            $('#subtitleLeft').text('SUBTITLE ' + countTitle + ' characters left (Min:30,Max:100)');

            /* fix val so it counts carriage returns */
            $.valHooks.textarea = {
                get: function(e) {
                    return e.value.replace(/\r?\n/g, "\r\n");
                }
            };

            function checkCountTitle() {
                textLengthTitle = $('#subtitle').val().length;
                if (textLengthTitle >= maxCharstitle) {
                    $('#subtitleLeft').text(outOfChars);
                } else {
                    countTitle = maxCharstitle - textLengthTitle;
                    $('#subtitleLeft').text('SUBTITLE ' + countTitle + ' characters left (Min:30,Max:100)');
                }
            }

            /* on keyUp: update #subtitleLeft as well as count & commentTitle in localStorage */
            $('#subtitle').keyup(function() {

                checkCountTitle();
                commentTitle = $(this).val();

            });

        });

    </script>


    <!-- SLUGTITLE CHARACTER -->

    <script type="text/javascript">
        /* TITLE:
                                                              http://www.findsourcecode.com/jquery/how-to-count-number-of-characters-in-textarea-jquery/ */
        $(document).ready(function() {
            var maxCharstitle = 100;
            var textLengthTitle = 0;
            var commentTitle = "";
            var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

            /* initalize for when no data is in localStorage */
            var countTitle = maxCharstitle;
            $('#slugtitleLeft').text('SLUG ' + countTitle + ' characters left (Min:30,Max:100)');

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
                } else {
                    countTitle = maxCharstitle - textLengthTitle;
                    $('#slugtitleLeft').text('SLUG ' + countTitle + ' characters left (Min:30,Max:100)');
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
        $(document).ready(function() {
            var maxCharstitle = 255;
            var textLengthTitle = 0;
            var commentTitle = "";
            var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

            /* initalize for when no data is in localStorage */
            var countTitle = maxCharstitle;
            $('#keywordtitleLeft').text('SEO KEYWORD ' + countTitle + ' characters left (Min:30,Max:255)');

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
                } else {
                    countTitle = maxCharstitle - textLengthTitle;
                    $('#keywordtitleLeft').text('SEO KEYWORD ' + countTitle + ' characters left (Min:30,Max:255)');
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
        $(document).ready(function() {
            var maxCharstitle = 165;
            var textLengthTitle = 0;
            var commentTitle = "";
            var outOfChars = 'You have reached the limit of ' + maxCharstitle + ' characters';

            /* initalize for when no data is in localStorage */
            var countTitle = maxCharstitle;
            $('#descriptiontitleLeft').text('SEO DESCRIPTION ' + countTitle + ' characters left (Min:30,Max:165)');

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
                } else {
                    countTitle = maxCharstitle - textLengthTitle;
                    $('#descriptiontitleLeft').text('SEO DESCRIPTION  ' + countTitle +
                        ' characters left (Min:30,Max:165)');
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
        $("#postjob").css({
            "background-color": "#00c5d0"
        });

    </script>





@endsection
