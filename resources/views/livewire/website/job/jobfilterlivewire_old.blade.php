<div>
    <div class="card border-0 mt-1">
        <div class="card-header fw-bold border-0" style="color: #131369;">
           Vacancy Type
        </div>
        <div class="list-group shadow-sm rounded-3">
            @foreach ($typejob as $eachtypjob)
            <label class="list-group-item list-group-item-action border-0">
                <input wire:model="jobtypefilterid.{{ $eachtypjob->id }}" class="form-check-input me-1" type="checkbox" value=true>
                {{ $eachtypjob->name }}
                <span class="badge bg-secondary rounded-pill float-end">{{ $eachtypjob->postjob()->count() }}</span>
                </label>
            @endforeach

                      {{-- <span class="list-group-item list-group-item-action border-0 px-3 py-0">
              <label class="form-check form-switch">
                  <input wire:model="jobtypefilterid.{{ $eachtypjob->id }}" class="form-check-input me-1" type="checkbox" value="true" />
                  <small> {{ $eachtypjob->name }} </small>
                  <span class="badge bg-secondary rounded-pill float-end">{{ $eachtypjob->postjob()->count() }}</span>
              </label>
          </span> --}}
        </div>
      </div>


      <div class="card border-0 mt-1">
        <div class="card-header fw-bold border-0" style="color: #131369;">
            Experience : {{$experience}}
        </div>
      <input type="range" wire:model="experience" class="form-range bg-light" min="0" max="40" id="customRange2">
      </div>



      <div class="card border-0 mt-1">
        <div class="card-header fw-bold border-0" style="color: #131369;">
           Location
        </div>
        <div class="list-group shadow-sm rounded-3">
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           First checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           Second checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           Third checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           Fourth checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
        </div>
      </div>
      <div class="card border-0 mt-1">
        <div class="card-header fw-bold border-0" style="color: #131369;">
           Job By Industry
        </div>
        <div class="list-group shadow-sm rounded-3">
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           First checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           Second checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           Third checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
           <label class="list-group-item list-group-item-action border-0">
           <input class="form-check-input me-1" type="checkbox" value="">
           Fourth checkbox
           <span class="badge bg-secondary rounded-pill float-end">14</span>
           </label>
        </div>
      </div>
</div>
