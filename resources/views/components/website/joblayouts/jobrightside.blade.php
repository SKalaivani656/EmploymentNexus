@php
$statejob = App\Models\Admin\Worldinfo\State::withCount('postjob')
    ->orderBy('postjob_count', 'desc')
    ->where('active', true)
    ->where('country_id', 101)
    ->take(20)
    ->get();
@endphp
@if ($statejob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/state') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            State
        </a>
        @foreach ($statejob->where('union_territories', false) as $eachstatejob)
            <small><a href="{{ route('jobtype', ['state', $eachstatejob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachstatejob->name }}<span>({{ $eachstatejob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif

@php $rolejob = App\Models\Admin\Job\Jobmaster\Rolejob::where('active', true)->get() @endphp
@if ($rolejob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/role') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Role
        </a>
        @foreach ($rolejob as $eachrolejob)
            <small><a href="{{ route('jobtype', ['role', $eachrolejob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted px-3 py-1">{{ $eachrolejob->name }}<span>({{ $eachrolejob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif

@php
$coursejob = App\Models\Admin\Job\Jobmaster\Coursejob::where('active', true)
    ->inRandomOrder()
    ->take(15)
    ->get();
@endphp
@if ($coursejob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/course') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Education
        </a>
        @foreach ($coursejob as $eachcoursejob)
            <small><a href="{{ route('jobtype', ['course', $eachcoursejob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted px-3 py-1">{{ $eachcoursejob->name }}<span>({{ $eachcoursejob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif

@php
$branchjob = App\Models\Admin\Job\Jobmaster\Branchjob::where('active', true)
    ->inRandomOrder()
    ->take(15)
    ->get();
@endphp
@if ($branchjob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/branch') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Branch
        </a>
        @foreach ($branchjob as $eachbranchjob)
            <small><a href="{{ route('jobtype', ['branch', $eachbranchjob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachbranchjob->name }}<span>({{ $eachbranchjob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif



@php $exam = App\Models\Admin\Exam\Master\Competitiveexam::where('active', true)
    ->inRandomOrder()
    ->take(15)
    ->get();
@endphp
@if ($exam->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/competitiveexam') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Competitive Exam
        </a>
        @foreach ($exam as $eachexam)
            <small><a href="{{ route('jobtype', ['competitiveexam', $eachexam->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachexam->name }}<span>({{ $eachexam->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif

@php $skilljob = App\Models\Admin\Job\Jobmaster\Skilljob::where('active', true)->get() @endphp
@if ($skilljob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/skill') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Skill
        </a>
        @foreach ($skilljob as $eachskilljob)
            <small><a href="{{ route('jobtype', ['skill', $eachskilljob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachskilljob->name }}<span>({{ $eachskilljob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif


@php $companyjob = App\Models\Admin\Job\Jobmaster\Companyjob::where('active', true)
    ->inRandomOrder()
    ->take(15)
    ->get();
@endphp
@if ($companyjob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/company') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Company
        </a>
        @foreach ($companyjob as $eachcompanyjob)
            <small><a href="{{ route('jobtype', ['company', $eachcompanyjob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachcompanyjob->name }}<span>({{ $eachcompanyjob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif


@php $typejob = App\Models\Admin\Job\Jobmaster\Typejob::where('active', true)->get() @endphp
@if ($typejob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/type') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Type
        </a>
        @foreach ($typejob as $eachtypejob)
            <small><a href="{{ route('jobtype', ['type', $eachtypejob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachtypejob->name }}<span>({{ $eachtypejob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif


@if ($statejob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/state') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Union Territories
        </a>
        @foreach ($statejob->where('union_territories', true) as $eachunion)
            <small><a href="{{ route('jobtype', ['state', $eachunion->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachunion->name }}<span>({{ $eachunion->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif


@php $categoryjob = App\Models\Admin\Job\Jobmaster\Categoryjob::where('active', true)->get() @endphp
@if ($categoryjob->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-list/category') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Category
        </a>
        @foreach ($categoryjob as $eachcategoryjob)
            <small><a href="{{ route('jobtype', ['category', $eachcategoryjob->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachcategoryjob->name }}<span>({{ $eachcategoryjob->postjob()->count() }})</span></a></small>
        @endforeach
    </div>
@endif


<!-- <div class="card shadow-sm mb-3 border-0 rounded-3">
     preparenext.com vertical 
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1817660922195990" data-ad-slot="1473750696"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});

    </script>
</div>
 -->
<div class="card shadow-sm mb-3 border-0 rounded-3 text-center">
    <img src="{{ url('images/banner.jpg') }}" 
         alt="Job Banner" 
         class="img-fluid rounded-3" 
         style="width:100%; height:auto;">
</div>
