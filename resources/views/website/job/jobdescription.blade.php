@extends('components.website.joblayouts.jobapp')
@section('leftsidefilter', false)
@section('title', $postjob ? $postjob->seo_title : '')
@section('description', $postjob ? $postjob->seo_description : '')
@section('keyword', $postjob ? $postjob->seo_keyword : '')
@section('image', $postjob && $postjob->companyjob && $postjob->companyjob->image ?
    asset('/storage/images/companyjob/images/' . $postjob->companyjob->image) : url('/logo/logo.jpg'))
@section('headSection')

    @if ($postjob->companyjob)
        <script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "@type": "JobPosting",
                "title": "{{ $postjob->title }}",
                @if ($postjob->coursejob->count() > 0)
                    "educationRequirements": {
                    "@type": "EducationalOccupationalCredential",
                    "credentialCategory": "{{ $postjob->coursejob->pluck('name')->implode(', ') }}"
                    },
                @endif
                @if ($postjob->min_exp)
                    "experienceRequirements": {
                    "@type": "OccupationalExperienceRequirements",
                    "monthsOfExperience": "{{ $postjob->min_exp * 12 }}"
                    },
                @endif "description": "{{ $postjob->seo_description }}",
                "identifier": {
                    "@type": "PropertyValue",
                    "name": "{{ $postjob->companyjob->name }}",
                    "value": "{{ $postjob->jobid ? $postjob->jobid : $postjob->uuid }}"
                },
                "workHours": "{{ $postjob->workhours }}",
                "datePosted": "{{ $postjob->postdate ? $postjob->postdate : $postjob->created_at }}",
                "validThrough": "{{ $postjob->lastdateapply ? $postjob->lastdateapply : $postjob->created_at->subDays(45) }}",
                "employmentType": "{{ $postjob->typejob->isNotEmpty() ? Config::get('archive.schemaorg_type')[$postjob->typejob[0]->schemaorg_type] : Config::get('archive.schemaorg_type')[1] }}",
                "hiringOrganization": {
                    "@type": "Organization",
                    "name": "{{ $postjob->companyjob->name }}",
                    "sameAs": "{{ $postjob->companyjob->websiteurl }}",
                    "logo": "{{ asset('/storage/images/companyjob/images/' . $postjob->companyjob->image) }}"
                },
                "jobLocation": {
                    "@type": "Place",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "{{ $postjob->streetaddress ? $postjob->streetaddress : '' }}",
                        "addressLocality": "{{ $postjob->state ? $postjob->state : '' }}",
                        "addressRegion": "{{ $postjob->city ? $postjob->city : '' }}",
                        "postalCode": "{{ $postjob->postcode ? $postjob->postcode : '' }}",
                        "addressCountry": "IN"
                    }
                },
                @if ($postjob->min_sal)
                    "baseSalary": {
                    "@type": "MonetaryAmount",
                    "currency": "INR",
                    "value": {
                    "@type": "QuantitativeValue",
                    @if ($postjob->max_sal)
                        "minValue": {{ $postjob->min_sal }},
                        "maxValue": {{ $postjob->max_sal }},
                    @else
                        "value": {{ $postjob->min_sal }},
                    @endif
                    "unitText": "{{ Config::get('archive.salarytype')[$postjob->salarytype] }}"
                    }
                    },
                @else
                    "baseSalary": {
                    "@type": "MonetaryAmount",
                    "currency": "INR",
                    "value": {
                    "@type": "QuantitativeValue",
                    "value": "",
                    "unitText": "MONTH"
                    }
                    },
                @endif "responsibilities": "{{ $postjob->responsibility }}",
                "skills": "{{ $postjob->skilljob->pluck('name')->implode(', ') }}",
                "qualifications": "{{ $postjob->branchjob->pluck('name')->implode(', ') }}"
            }, {
                "@context": "https://schema.org",
                "@type": "NewsArticle",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ Request::url() }}"
                },
                "headline": "{{ $postjob->title }}",
                "image": [
                    "{{ asset('/storage/images/companyjob/images/' . $postjob->companyjob->image) }}"
                ],
                "datePublished": "{{ $postjob->postdate ? $postjob->postdate : $postjob->created_at }}",
                "dateModified": "{{ $postjob->lastdateapply ? $postjob->lastdateapply : $postjob->created_at->subDays(45) }}",
                "author": {
                    "@type": "Person",
                    "name": "Vimalraj",
                    "url": "https://preparenext.com/about-us"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "PrepareNext.Com",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ url('/logo/logo.jpg') }}"
                    }
                },
                "description": "{{ $postjob->seo_description }}"
            }, {
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Jobs",
                    "item": "https://preparenext.com/"
                }, {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "{{ $postjob->categoryjob->pluck('name')->implode(', ') }}",
                    "item": "https://preparenext.com/jobs/category/{{ $postjob->categoryjob->first()->slug }}"
                }, {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $postjob->title }}"
                }]
            }

        </script>
    @endif

@endsection


@section('main-content')

    <div class="card shadow-sm border-0 rounded-3 ">
        {{-- <a class="text-decoration-none" href="{{ url('/jobs/'.$postjob->slug .'/'.$postjob->id) }}">
  <div class="card-header text-white fs-6 fw-bold" style="background-color:#37474f;">
    {{ $postjob->title }}
  </div>
</a> --}}

        <div class="row g-0">



            <div class="col-10">
                <div class="card-body pb-0">

                    <h1 class="card-title fs-6 text-dark fw-bold">{{ $postjob->title }}</h1>
                    {{-- <h2 class="fs-6 fw-bold text-primary"><small>{{ $postjob->subtitle }}</small></h2> --}}




                    {{-- --------JOB COMPANY ------------ --}}

                    @if ($postjob->companyjob)
                        <h2 class="fs-6 fw-bold mb-0">
                            <small>
                                <a href="{{ route('jobtype', ['company', $postjob->companyjob->slug]) }}"
                                    class="fw-bold text-decoration-none" target="_blank">
                                    {{ $postjob->companyjob->name }}
                                </a>
                            </small>
                        </h2>
                    @endif



                    {{-- --------JOB CATEGORY ------------ --}}

                    @if ($postjob->categoryjob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->categoryjob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Category :
                                @foreach ($postjob->categoryjob as $eachcategory)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['category', $eachcategory->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachcategory->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif

                    {{-- --------JOB ROLE ------------ --}}

                    @if ($postjob->rolejob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->rolejob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Role :
                                @foreach ($postjob->rolejob as $eachrole)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['role', $eachrole->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachrole->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif

                    {{-- --------JOB COURSE (EDUCATION) ------------ --}}

                    @if ($postjob->coursejob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->coursejob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Education :
                                @foreach ($postjob->coursejob as $eachcourse)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['course', $eachcourse->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachcourse->shortname }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif


                    {{-- --------JOB BRANCH ------------ --}}

                    @if ($postjob->branchjob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->branchjob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Branch :
                                @foreach ($postjob->branchjob as $eachbranch)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['branch', $eachbranch->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachbranch->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif

                    {{-- --------JOB LANGUAGE ------------ --}}

                    @if ($postjob->languagejob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->languagejob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Language :
                                @foreach ($postjob->languagejob as $eachlanguage)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['language', $eachlanguage->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachlanguage->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif


                    {{-- --------JOB SKILL ------------ --}}

                    @if ($postjob->skilljob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->skilljob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Skills :
                                @foreach ($postjob->skilljob as $eachskill)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['skill', $eachskill->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachskill->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif


                    {{-- --------JOB SKILL ------------ --}}

                    @if ($postjob->tagjob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->tagjob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Tags :
                                @foreach ($postjob->tagjob as $eachtag)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['tag', $eachtag->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachtag->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif



                    {{-- --------JOB TYPE ------------ --}}

                    @if ($postjob->typejob->isNotEmpty())
                        <div>
                            @php
                                $num_of_items = count($postjob->typejob);
                                $num_count = 0;
                            @endphp
                            <small class="fw-bold text-sm text-dark hoverlink">
                                Types :
                                @foreach ($postjob->typejob as $eachtype)
                                    @php $num_count = $num_count + 1; @endphp
                                    <a href="{{ route('jobtype', ['type', $eachtype->slug]) }}"
                                        class="fw-normal text-dark text-decoration-none" target="_blank">
                                        {{ $eachtype->name }}
                                    </a>
                                    @if ($num_count < $num_of_items)
                                        <span>,</span>
                                    @endif
                                @endforeach
                            </small><br>
                        </div>
                    @endif



                    <div class="row">
                        @php
                            if ($postjob->min_exp && $postjob->max_exp) {
                                $experience = $postjob->min_exp . '-' . $postjob->max_exp . ' Yrs';
                            } elseif ($postjob->min_exp) {
                                $experience = $postjob->min_exp . ' Yrs Above';
                            } else {
                                $experience = null;
                            }
                        @endphp
                        @if ($experience)
                            <div class="col-auto">
                                {{-- <small><i class="bi bi-arrow-clockwise"></i> {{ $experience }}</small> --}}
                                <small><b>Experience : </b> {{ $experience }}</small>
                            </div>
                        @endif

                        <div class="col-auto">
                            @php
                                if ($postjob->min_sal && $postjob->max_sal) {
                                    $salary = $postjob->min_sal . '-' . $postjob->max_sal;
                                } elseif ($postjob->min_sal) {
                                    $salary = $postjob->min_sal;
                                } else {
                                    $salary = 'Not Disclosed';
                                }
                            @endphp
                            <small><b>Salary</b> &#8377;{{ $salary }}</small>
                        </div>
                        @if ($postjob->country)
                            <div class="col-auto">
                                <small>
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <a class="font-weight-bold text-dark text-decoration-none"
                                        href="{{ route('jobtype', ['country', $postjob->country]) }}">
                                        {{ $postjob->country }}</a>
                                    @if ($postjob->state)
                                        <span>,</span> <a class="font-weight-bold text-dark text-decoration-none"
                                            href="{{ route('jobtype', ['state', Str::slug($postjob->state, '-')]) }}">{{ $postjob->state }}</a>
                                    @endif
                                    @if ($postjob->city)
                                        <span>,</span> <a class="font-weight-bold text-dark text-decoration-none"
                                            href="{{ route('jobtype', ['city', Str::slug($postjob->city, '-')]) }}">{{ $postjob->city }}</a>
                                    @endif
                                </small>
                            </div>
                        @endif
                    </div>

                    {{-- -------- Date ------------ --}}



                    @if ($postjob->postdate)
                        <small><b>Post Date: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->postdate)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->startdateapply)
                        <small><b>Start Date Apply: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->startdateapply)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->lastdateapply)
                        <small><b>Last Date Apply: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->lastdateapply)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->documentsubmissiondate)
                        <small><b>Document Submission Date: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->documentsubmissiondate)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->extendeddateapply)
                        <small><b>Extended Date Apply: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->extendeddateapply)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->examdate)
                        <small><b>Exam Date: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->examdate)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->interviewdate)
                        <small><b>Interview Date: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->interviewdate)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->finalresultdate)
                        <small><b>Final Result Date: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->finalresultdate)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                    @if ($postjob->dateofjoining)
                        <small><b>Date of Joining: </b><span
                                class="text-dark">{{ \Carbon\Carbon::parse($postjob->dateofjoining)->format('d-M-Y') }}</span>
                        </small><br>
                    @endif
                </div>
            </div>
            <div class="col-2">
                @if ($postjob->companyjob)
                    <a href="{{ route('jobtype', ['company', $postjob->companyjob->slug]) }}" target="_blank">

                        <img src="{{ asset('/storage/images/companyjob/thumbnail/' . $postjob->companyjob->image) }}"
                            class="img-fluid img-thumbnail my-2  p-1" width="70" height="70" loading="lazy"
                            alt="{{ $postjob->companyjob->image_alttag }}">
                    </a>

                    <a href="javascript:void(0)" class="float-end pt-3 me-4" data-bs-toggle="tooltip" title="Share"
                        onclick="sharemodal('{{ $postjob->title }}', '{{ url('/jobs/' . $postjob->slug) }}')">
                        <i class="bi bi-share-fill text-secondary" data-bs-toggle="modal" data-bs-target="#sharemodal"
                            style="font-size: 1.5rem"></i>
                    </a>


                @endif
            </div>
        </div>

        <div class="card-body mt-0 py-0">
            {{-- -------- COUNTRY STATE CITY ------------ --}}

            <div class="my-2">
                <b> Job Description : </b>
            </div>

            {!! $postjob->body !!}


            @if ($postjob->notificationlinkjob->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered shadow-sm">
                        <thead>
                            <tr>
                                <th style="color: #00c5d0;" colspan="2">Important Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postjob->notificationlinkjob as $eachimportantlinkjobs)
                                <tr>
                                    <td>{{ $eachimportantlinkjobs->notification_name }}</td>
                                    <td><a target="_blank"
                                            href="{{ $eachimportantlinkjobs->notification_link }}"><b>{{ $eachimportantlinkjobs->notification_source }}</b></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($postjob->video_status && $postjob->video_link)
                <video style="height: 350px;" id="vid2" class="video-js vjs-default-skin w-auto" controls
                    data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $postjob->video_link }}"}] }'>
                </video>
            @endif

            <small class="text-dark p-2 shadow float-end">
                <i class="bi bi bi-clock"></i>
                {{ $postjob->created_at->diffForHumans() }}
            </small>
        </div>

        @if ($postjob->jobcomment)
            <div class="card-body shadow-sm">
                @include('helper.comments.disqus')
            </div>
        @endif

    </div>


    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-header bg-white">
            <b style="color:orangered"> Related Jobs </b>
        </div>
    </div>



    @livewire('website.job.jobhomepagelistlivewire', [
    'postjob_id' => $postjob->id,
    'classifyname' => null,
    'classifytitle' => null,
    'classifyid' => null])

@endsection



@section('footerSection')

    @if ($postjob->video_status && $postjob->video_link)
        <link href="{{ asset('youtube/video-js.css') }}" rel="stylesheet">
        <script src="{{ asset('youtube/video.min.js') }}"></script>
        <script src="{{ asset('youtube/youtube.min.js') }}"></script>
    @endif

@endsection
