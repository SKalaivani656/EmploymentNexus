<a href="{{ URL('jobs-blog/' . $eachpostblog->slug) }}" class="text-decoration-none">
    <div class="card mb-3">
        <img src="{{ asset('/storage/images/blog/thumbnail/' . $eachpostblog->image) }}" class="card-img-top"
            alt="{{ $eachpostblog->image_alttag }}">
        <div class="card-body">
            <h5 class="card-title text-dark">{{ $eachpostblog->title }}</h5>
            <span class="card-text text-dark">{!! $eachpostblog->short_description !!}</span>

            {{-- --------BLOG CAGETORY ------------ --}}

            @if ($eachpostblog->categoryblog->isNotEmpty())
                @php
                    $num_of_items = count($eachpostblog->categoryblog);
                    $num_count = 0;
                @endphp
                <div class="float-start fw-bold text-sm  hoverlink">
                    <span class="text-dark"> Category : </span>
                    @foreach ($eachpostblog->categoryblog as $eachcategory)
                        @php $num_count = $num_count + 1; @endphp
                        <a href="{{ route('categoryblog', [$eachcategory->slug]) }}"
                            class="fw-normal text-dark text-decoration-none" target="_blank">
                            {{ $eachcategory->name }}
                        </a>
                        @if ($num_count < $num_of_items)
                            <small>,</small>
                        @endif
                    @endforeach
                </div>
                <div class="float-end">
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" title="Share"
                        onclick="sharemodal('{{ $eachpostblog->title }}', '{{ URL('jobs-blog/' . $eachpostblog->slug) }}')">
                        <i class="bi bi-share-fill text-secondary" data-bs-toggle="modal" data-bs-target="#sharemodal"
                            style="font-size: 1.3rem"></i>
                    </a>
                </div>
            @endif


            {{-- --------BLOG TAGS ------------ --}}

            @if ($eachpostblog->tagblog->isNotEmpty())
                @php
                    $num_of_items = count($eachpostblog->tagblog);
                    $num_count = 0;
                @endphp
                <br>
                <div class="fw-bold text-sm hoverlink">
                    <span class="text-dark">Tag :</span>
                    @foreach ($eachpostblog->tagblog as $eachtag)
                        @php $num_count = $num_count + 1; @endphp
                        <a href="{{ route('tagblog', [$eachtag->slug]) }}"
                            class="fw-normal text-dark text-decoration-none" target="_blank">
                            {{ $eachtag->name }}
                        </a>
                        @if ($num_count < $num_of_items)
                            <small>,</small>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>

        <a class="text-decoration-none" href="{{ url('/jobs-blog/' . $eachpostblog->slug) }}">
            <div class="card-footer clearfix">
                <small class="text-secondary text-semibold float-start">
                    <i class="bi bi bi-clock"></i>
                    {{ $eachpostblog->created_at->diffForHumans() }}</small>
                <span class="float-end fw-bold">
                    <div class="text-decoration-none" style="color:#00c5d0;" data-bs-toggle="tooltip"
                        title="Click Here"><small>For More Details</small></div>
                </span>
            </div>
        </a>
    </div>
</a>
