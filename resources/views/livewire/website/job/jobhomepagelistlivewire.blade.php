<div>
    @if ($postjob->isNotEmpty())
        @if ($classifyname != 'all')
            <p><b> Search item : <span style="color:#00c5d0;">{{ $classifytitle }} </span> </b></p>
        @endif
        @foreach ($postjob as $eachpostjob)
            <div class="card shadow-sm mb-3 border-0 rounded-3">
                {{-- <a class="text-decoration-none" href="{{ url('/jobs/'.$eachpostjob->slug .'/'.$eachpostjob->id) }}">
      <div class="card-header text-white fs-6 fw-bold" style="background-color:#37474f;">
        {{ $eachpostjob->title }}
      </div>
    </a> --}}

                <div class="row g-0">



                    <div class="col-10">
                        <div class="card-body">
                            <a class="text-decoration-none" target="_blank"
                                href="{{ url('/jobs/' . $eachpostjob->slug) }}">
                                @if ($loop->first)
                                    <h1 class="card-title fs-6 text-dark fw-bold">{{ $eachpostjob->title }}</h1>
                                    @if ($eachpostjob->companyjob)
                                        <h2 class="fs-6 fw-bold mb-0">
                                            <small>
                                                <a href="{{ route('jobtype', ['company', $eachpostjob->companyjob->slug]) }}"
                                                    class="fw-bold text-decoration-none" target="_blank">
                                                    {{ $eachpostjob->companyjob->name }}
                                                </a>
                                            </small>
                                        </h2>
                                    @endif
                                @else
                                    <h3 class="card-title fs-6 text-dark fw-bold">{{ $eachpostjob->title }}</h3>
                                    @if ($eachpostjob->companyjob)
                                        <h4 class="fs-6 fw-bold mb-0">
                                            <small>
                                                <a href="{{ route('jobtype', ['company', $eachpostjob->companyjob->slug]) }}"
                                                    class="fw-bold  text-decoration-none" target="_blank">
                                                    {{ $eachpostjob->companyjob->name }}
                                                </a>
                                            </small>
                                        </h4>
                                    @endif
                                @endif
                            </a>



                            {{-- --------JOB COMPANY ------------ --}}

                            {{-- --------DESIGNATION TYPE ------------ --}}

                            @if ($eachpostjob->designationjob->isNotEmpty())
                                @php
                                    $num_of_items = count($eachpostjob->designationjob);
                                    $num_count = 0;
                                @endphp
                                <small class="fw-bold text-sm text-dark hoverlink">
                                    Designation :
                                    @foreach ($eachpostjob->designationjob as $eachdesignation)
                                        @php $num_count = $num_count + 1; @endphp
                                        <a href="{{ route('jobtype', ['designation', $eachdesignation->slug]) }}"
                                            class="fw-normal text-dark text-decoration-none" target="_blank">
                                            {{ $eachdesignation->name }}
                                        </a>
                                        @if ($num_count < $num_of_items)
                                            <small>,</small>
                                        @endif
                                    @endforeach
                                </small><br>
                            @endif



                            {{-- --------JOB COURSE/EDUCATION ------------ --}}

                            @if ($eachpostjob->coursejob->isNotEmpty())
                                @php
                                    $num_of_items = count($eachpostjob->coursejob);
                                    $num_count = 0;
                                @endphp
                                <small class="fw-bold text-sm text-dark hoverlink">
                                    Education :
                                    @foreach ($eachpostjob->coursejob as $eachcourse)
                                        @php $num_count = $num_count + 1; @endphp
                                        <a href="{{ route('jobtype', ['course', $eachcourse->slug]) }}"
                                            class="fw-normal text-dark text-decoration-none" target="_blank">
                                            {{ $eachcourse->shortname }}
                                        </a>
                                        @if ($num_count < $num_of_items)
                                            <small>,</small>
                                        @endif
                                    @endforeach
                                </small><br>
                            @endif


                            {{-- --------JOB BRANCH ------------ --}}

                            @if ($eachpostjob->branchjob->isNotEmpty())
                                @php
                                    $num_of_items = count($eachpostjob->branchjob);
                                    $num_count = 0;
                                @endphp
                                <small class="fw-bold text-sm text-dark hoverlink">
                                    Branch :
                                    @foreach ($eachpostjob->branchjob as $eachbranch)
                                        @php $num_count = $num_count + 1; @endphp
                                        <a href="{{ route('jobtype', ['branch', $eachbranch->slug]) }}"
                                            class="fw-normal text-dark text-decoration-none" target="_blank">
                                            {{ $eachbranch->name }}
                                        </a>
                                        @if ($num_count < $num_of_items)
                                            <small>,</small>
                                        @endif
                                    @endforeach
                                </small><br>
                            @endif

                            {{-- --------JOB SKILL ------------ --}}

                            @if ($eachpostjob->skilljob->isNotEmpty())
                                @php
                                    $num_of_items = count($eachpostjob->skilljob);
                                    $num_count = 0;
                                @endphp
                                <small class="fw-bold text-sm text-dark hoverlink">
                                    Skills :
                                    @foreach ($eachpostjob->skilljob as $eachskill)
                                        @php $num_count = $num_count + 1; @endphp
                                        <a href="{{ route('jobtype', ['skill', $eachskill->slug]) }}"
                                            class="fw-normal text-dark text-decoration-none" target="_blank">
                                            {{ $eachskill->name }}
                                        </a>
                                        @if ($num_count < $num_of_items)
                                            <small>,</small>
                                        @endif
                                    @endforeach
                                </small><br>
                            @endif


                            {{-- --------JOB TYPE ------------ --}}

                            @if ($eachpostjob->typejob->isNotEmpty())
                                @php
                                    $num_of_items = count($eachpostjob->typejob);
                                    $num_count = 0;
                                @endphp
                                <small class="fw-bold text-sm text-dark hoverlink">
                                    Type :
                                    @foreach ($eachpostjob->typejob as $eachtype)
                                        @php $num_count = $num_count + 1; @endphp
                                        <a href="{{ route('jobtype', ['type', $eachtype->slug]) }}"
                                            class="fw-normal text-dark text-decoration-none" target="_blank">
                                            {{ $eachtype->name }}
                                        </a>
                                        @if ($num_count < $num_of_items)
                                            <small>,</small>
                                        @endif
                                    @endforeach
                                </small><br>
                            @endif





                            <div class="row">
                                @php
                                    if ($eachpostjob->min_exp && $eachpostjob->max_exp) {
                                        $experience = $eachpostjob->min_exp . '-' . $eachpostjob->max_exp . ' Yrs';
                                    } elseif ($eachpostjob->min_exp) {
                                        $experience = $eachpostjob->min_exp . ' Yrs Above';
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
                                        if ($eachpostjob->min_sal && $eachpostjob->max_sal) {
                                            $salary = $eachpostjob->min_sal . '-' . $eachpostjob->max_sal;
                                        } elseif ($eachpostjob->min_sal) {
                                            $salary = $eachpostjob->min_sal;
                                        } else {
                                            $salary = 'Not Disclosed';
                                        }
                                    @endphp
                                    <small><span class="fw-bold">Salary</span>
                                        &#8377;{{ $salary }}</small>
                                </div>
                                @if ($eachpostjob->country)
                                    <div class="col-auto">
                                        <small>
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <a class="font-weight-bold text-dark text-decoration-none"
                                                href="{{ route('jobtype', ['country', $eachpostjob->country]) }}">
                                                {{ $eachpostjob->country }}</a>
                                            @if ($eachpostjob->state)
                                                <small>,</small> <a
                                                    class="font-weight-bold text-dark text-decoration-none"
                                                    href="{{ route('jobtype', ['state', Str::slug($eachpostjob->state, '-')]) }}">{{ $eachpostjob->state }}</a>
                                            @endif
                                            @if ($eachpostjob->city)
                                                <small>,</small> <a
                                                    class="font-weight-bold text-dark text-decoration-none"
                                                    href="{{ route('jobtype', ['city', Str::slug($eachpostjob->city, '-')]) }}">{{ $eachpostjob->city }}</a>
                                            @endif
                                        </small>
                                    </div>
                                @endif
                            </div>

                            {{-- -------- COUNTRY STATE CITY ------------ --}}




                        </div>
                    </div>
                    <div class="col-2">
                        @if ($eachpostjob->companyjob)
                            <a href="{{ route('jobtype', ['company', $eachpostjob->companyjob->slug]) }}"
                                target="_blank">

                                <img src="{{ asset('/storage/images/companyjob/thumbnail/' . $eachpostjob->companyjob->image) }}"
                                    class="img-fluid img-thumbnail my-2  p-1" width="70" height="70" loading="lazy"
                                    alt="{{ $eachpostjob->companyjob->image_alttag }}">
                            </a>
                            <a href="javascript:void(0)" class="float-end pt-3 me-4" data-bs-toggle="tooltip"
                                title="Share"
                                onclick="sharemodal('{{ $eachpostjob->title }}', '{{ url('/jobs/' . $eachpostjob->slug) }}')">
                                <i class="bi bi-share-fill text-secondary" data-bs-toggle="modal"
                                    data-bs-target="#sharemodal" style="font-size: 1.5rem"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <a class="text-decoration-none" target="_blank" href="{{ url('/jobs/' . $eachpostjob->slug) }}">
                    <div class="card-footer clearfix">
                        <small class="text-secondary text-semibold float-start">
                            <i class="bi bi bi-clock"></i>
                            {{ $eachpostjob->created_at->diffForHumans() }}</small>
                        <span class="float-end fw-bold">
                            <div class="text-decoration-none" style="color:#00c5d0;" data-bs-toggle="tooltip"
                                title="Click Here"><small>View & Apply</small></div>
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <p><b> Search item : <span style="color:#00c5d0;">{{ $classifytitle }} </span></b></p>
        <span> Oops! No Search Result Found </span>
    @endif




    <div class="pagination justify-content-center m-4">
        {{ $postjob->onEachSide(1)->links() }}
    </div>
</div>
