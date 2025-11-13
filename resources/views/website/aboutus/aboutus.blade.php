@extends('components.website.joblayouts.jobapp')
@section('leftsidefilter', false)
@section('title', 'Job Seekers can use our platform for finding jobs')
@section('description',
    'As a new job portal for freshers, EmploymentNexus offers opportunities to trainees and
    experienced professionals, which can be useful if you are looking for a job as a fresher.',)
@section('keyword',
    'job portal, freshers jobs,
    government jobs in india, latest
    government jobs in india',)
@section('image', url('/logo/logo.jpg'))
@section('headSection')
@endsection

@section('main-content')

    <div class="card mt-3 border-0 shadow-sm">
        <h5 class="card-header">About Us</h5>
        <div class="card-body">
            <p class="card-text">As a new job portal for freshers, EmploymentNexus offers opportunities to trainees and
                experienced professionals, which can be useful if you are looking for a job as a fresher. </p>
            <p class="card-text">Job Seekers can use our platform for finding jobs, as well as getting connections to the
                right people, and to find jobs on-demand or as per their industry preference.
            <p class="card-text">We provide free job alerts every day and you can subscribe to receive emails every day
                about free jobs. With our assistance, we can help fresh graduates find employment with all levels of
                government and multinational companies in India.
            </p>
            <p class="card-text">In the near future, we will give more details, such as government exam notifications and
                other information</p>
            {{-- <p class="card-text">
                <a class="text-decoration-none" href="mailto:info@preparenext.com">
                    <i class="bi bi-envelope-fill"></i>
                    info@preparenext.com
                </a>
            </p> --}}
        </div>
    </div>

@endsection

@section('footerSection')
@endsection
