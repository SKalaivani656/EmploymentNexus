<div class="accordion mt-3 shadow-sm" id="accordionExample">
    @if ($typejob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobType">
                <button wire:click="filtermenuclick('type')"
                    class="accordion-button {{ $menuactiveflag == 'type' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobType" aria-expanded="true"
                    aria-controls="collapseJobType">
                    Job Types
                </button>
            </h2>
            <div id="collapseJobType"
                class="accordion-collapse  {{ $menuactiveflag == 'type' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobType" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    @foreach ($typejob as $eachtypjob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="jobtypefilterid.{{ $eachtypjob->id }}" class="form-check-input me-1"
                                type="checkbox" value="true" />
                            <small> {{ $eachtypjob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachtypjob->postjob()->count() }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if ($skilljob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobSkill">
                <button wire:click="filtermenuclick('skill')"
                    class="accordion-button {{ $menuactiveflag == 'skill' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobSkill" aria-expanded="false"
                    aria-controls="collapseJobSkill">
                    Skill
                </button>
            </h2>
            <div id="collapseJobSkill"
                class="accordion-collapse {{ $menuactiveflag == 'skill' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobSkill" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    @foreach ($skilljob as $eachskilljob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="jobskillfilterid.{{ $eachskilljob->id }}" class="form-check-input me-1"
                                type="checkbox" value="true" />
                            <small> {{ $eachskilljob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachskilljob->postjob()->count() }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if ($categoryjob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobCategory">
                <button wire:click="filtermenuclick('category')"
                    class="accordion-button {{ $menuactiveflag == 'category' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobCategory" aria-expanded="false"
                    aria-controls="collapseJobCategory">
                    Category
                </button>
            </h2>
            <div id="collapseJobCategory"
                class="accordion-collapse {{ $menuactiveflag == 'category' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobCategory" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    @foreach ($categoryjob as $eachcategoryjob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="jobcategoryfilterid.{{ $eachcategoryjob->id }}"
                                class="form-check-input me-1" type="checkbox" value="true" />
                            <small> {{ $eachcategoryjob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachcategoryjob->postjob()->count() }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if ($coursejob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobCourse">
                <button wire:click="filtermenuclick('course')"
                    class="accordion-button {{ $menuactiveflag == 'course' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobCourse" aria-expanded="false"
                    aria-controls="collapseJobCourse">
                    Education
                </button>
            </h2>
            <div id="collapseJobCourse"
                class="accordion-collapse {{ $menuactiveflag == 'course' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobCourse" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    @foreach ($coursejob as $eachcoursejob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="jobcoursefilterid.{{ $eachcoursejob->id }}"
                                class="form-check-input me-1" type="checkbox" value="true" />
                            <small> {{ $eachcoursejob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachcoursejob->postjob()->count() }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="accordion-item border-0">
        <h2 class="accordion-header" id="headingJobExperienceFilter">
            <button wire:click="filtermenuclick('experience')"
                class="accordion-button {{ $menuactiveflag == 'experience' ? '' : 'collapsed' }}" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseJobExperienceFilter" aria-expanded="false"
                aria-controls="collapseJobExperienceFilter">
                Experience
            </button>
        </h2>
        <div id="collapseJobExperienceFilter"
            class="accordion-collapse {{ $menuactiveflag == 'experience' ? 'show' : 'collapse' }}"
            aria-labelledby="headingJobExperienceFilter" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <label for="expirencerange" class="form-label text-muted fw-bold">Expeirence(0-40) : <span
                        class="text-dark">{{ $experiencefilter }}</span></label>
                <input type="range" wire:model="experiencefilter" wire:change="jobexperiencyfilter"
                    wire:keyup="jobexperiencyfilter" class="form-range bg-white" min="0" max="40" id="expirencerange">
            </div>
        </div>
    </div>
    @if ($cityjob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobCity">
                <button wire:click="filtermenuclick('city')"
                    class="accordion-button {{ $menuactiveflag == 'city' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobCity" aria-expanded="false"
                    aria-controls="collapseJobCity">
                    Location
                </button>
            </h2>
            <div id="collapseJobCity"
                class="accordion-collapse {{ $menuactiveflag == 'city' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobCity" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    @foreach ($cityjob as $eachcityjob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="jobcityfilterid.{{ $eachcityjob->id }}" class="form-check-input me-1"
                                type="checkbox" value="true" />
                            <small> {{ $eachcityjob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachcityjob->postjob()->count() }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if ($companyjob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobTopCompany">
                <button wire:click="filtermenuclick('company')"
                    class="accordion-button {{ $menuactiveflag == 'company' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobTopCompany" aria-expanded="false"
                    aria-controls="collapseJobTopCompany">
                    Top Company
                </button>
            </h2>
            <div id="collapseJobTopCompany"
                class="accordion-collapse {{ $menuactiveflag == 'company' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobTopCompany" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    <!-- @foreach ($companyjob as $eachcompanyjob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="jobtopcompanyfilterid.{{ $eachcompanyjob->id }}"
                                class="form-check-input me-1" type="checkbox" value="true" />
                            <small> {{ $eachcompanyjob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachcompanyjob->postjob()->count() }}</span>
                        </label>
                    @endforeach -->
                    @foreach ($companyjob as $eachcompanyjob)
    <label class="list-group-item list-group-item-action border-0 px-3 py-1 d-flex align-items-center">
        @if($eachcompanyjob->image)
            <img src="{{ asset('images/companyjob/images/' . $eachcompanyjob->image) }}" 
                 alt="{{ $eachcompanyjob->name }}" 
                 class="img-thumbnail me-2" 
                 style="width:50px; height:50px;">
        @endif
        <small>{{ $eachcompanyjob->name }}</small>
        <span class="badge bg-light text-dark rounded-pill float-end">
            {{ $eachcompanyjob->postjob()->count() }}
        </span>
    </label>
@endforeach

                </div>
            </div>
        </div>
    @endif
    @if ($languagejob->isNotEmpty())
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingJobLanguage">
                <button wire:click="filtermenuclick('language')"
                    class="accordion-button {{ $menuactiveflag == 'language' ? '' : 'collapsed' }}" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseJobLanguage" aria-expanded="false"
                    aria-controls="collapseJobLanguage">
                    Language
                </button>
            </h2>
            <div id="collapseJobLanguage"
                class="accordion-collapse {{ $menuactiveflag == 'language' ? 'show' : 'collapse' }}"
                aria-labelledby="headingJobLanguage" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0">
                    @foreach ($languagejob as $eachlanguagejob)
                        <label class="list-group-item list-group-item-action border-0 px-3 py-1">
                            <input wire:model="joblanguagefilterid.{{ $eachlanguagejob->id }}"
                                class="form-check-input me-1" type="checkbox" value="true" />
                            <small> {{ $eachlanguagejob->name }} </small>
                            <span
                                class="badge bg-light text-dark rounded-pill float-end">{{ $eachlanguagejob->postjob()->count() }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="accordion-item border-0">
        <h2 class="accordion-header" id="headingJobSalaryFilter">
            <button wire:click="filtermenuclick('salary')"
                class="accordion-button {{ $menuactiveflag == 'salary' ? '' : 'collapsed' }}" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseJobSalaryFilter" aria-expanded="false"
                aria-controls="collapseJobSalaryFilter">
                Salary
            </button>
        </h2>
        <div id="collapseJobSalaryFilter"
            class="accordion-collapse {{ $menuactiveflag == 'salary' ? 'show' : 'collapse' }}"
            aria-labelledby="headingJobSalaryFilter" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <label for="expirencerange" class="form-label text-muted fw-bold">0-100 Laksh : <span
                        class="text-dark">{{ $salaryfilter }} {{ isset($salaryfilter) ? 'L' : '' }} </span>
                </label>
                <input type="range" wire:model="salaryfilter" wire:change="jobsalaryfilter" wire:keyup="jobsalaryfilter"
                    class="form-range bg-white" min="0" max="100" id="expirencerange">
            </div>
        </div>
    </div>
</div>
