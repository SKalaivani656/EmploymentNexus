<div class="relative">
    <input type="text" class="form-control me-2" placeholder="Search Jobs..." wire:model="query"
        wire:keydown.escape="resetpage" wire:keydown.tab="resetpage" />

    <ul wire:loading class="list-group">
        <li class="list-group-item">Searching...</li>
    </ul>

    @if (!empty($query))
        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resetpage"></div>

        <div class="dropdown">
            <ul class="list-group dropdown-menu py-0">
                @if (!empty($joblist))
                    @foreach ($joblist as $i => $eachpostjob)
                        <li wire:click="selectJob" class="list-group-item list-group-item-action"
                            style="cursor: pointer;">
                            {{ $eachpostjob['title'] }}
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item">No results!</li>
                @endif
            </ul>
        </div>
    @endif
</div>

<!-- <div class="card shadow-sm mb-3 border-0 rounded-3">
    
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1817660922195990" data-ad-slot="1473750696"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});

    </script>
</div> -->
<div class="card shadow-sm mb-3 border-0 rounded-3 text-center">
    <img src="{{ url('images/banner.jpg') }}" 
         alt="Job Banner" 
         class="img-fluid rounded-3" 
         style="width:100%; height:auto;">
</div>
