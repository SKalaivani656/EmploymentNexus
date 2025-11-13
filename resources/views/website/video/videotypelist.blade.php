@extends('components.website.videolayouts.videoapp')
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
            <b style="color:orangered"> List of Video {{ Str::ucfirst(Str::plural($list)) }} </b>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($data as $key => $value)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route($list . 'video', [$value->slug]) }}" class="text-decoration-none fs-6 fw-bold ">
                            {{ $key + 1 }}. {{ $value->name }}</a>
                        <span class="badge bg-primary rounded-pill">{{ $value->postvideo()->count() }}</span>

                    </li>
                @endforeach
            </ul>

        </div>
        @if ($data->hasPages())
            <div class="pagination justify-content-center m-4">
                {{ $data->links() }}
            </div>
        @endif
    </div>
@endsection

@section('footerSection')
@endsection
