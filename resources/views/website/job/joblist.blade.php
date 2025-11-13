@extends('components.website.joblayouts.jobapp')
@section('leftsidefilter', false)
@section('title', $data ? $data->first()->seo_title : '')
@section('description', $data ? $data->first()->seo_description : '')
@section('keyword', $data ? $data->first()->seo_keyword : '')
@section('image', $data ? url('/images/blog/images/' . $data->first()->image) : '')
@section('headSection')
@endsection


@section('main-content')
    <div class="card mb-3 border-0 shadow-sm">

        <div class="card-header bg-white">
            @if ($list == 'state')
                <b style="color:orangered"> List of States & Union Territories</b>
            @else
                <b style="color:orangered"> List of {{ Str::ucfirst(Str::plural($list)) }} </b>
            @endif
        </div>

        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($data as $key => $value)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('jobtype', [$list, $value->slug]) }}"
                            class="text-decoration-none fs-6 fw-bold ">
                            {{ $key + 1 }}. {{ $value->name }}</a>
                        <span class="badge bg-primary rounded-pill">{{ $value->postjob()->count() }}</span>

                    </li>
                @endforeach
            </ul>
        </div>

    </div>
@endsection

@section('footerSection')
@endsection
