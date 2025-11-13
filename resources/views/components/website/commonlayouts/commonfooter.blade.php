<div>
    @livewire('website.footer.websitesubscribeslivewire')
    @include('helper.share.share')
    <footer class="bd-footer mt-3 bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                    <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="/"
                        aria-label="Bootstrap">
                        <!-- <img class="d-block mx-auto me-2" src="{{ url('/logo/logo.jpg') }}" alt="preparenext.com logo"
                            width="25" height="25" loading="lazy"> -->
                            <img class="d-block mx-auto me-2" src="{{ asset('logo/logok.jpg') }}" alt="EmploymentNexus.com logo"
    width="25" height="25" loading="lazy">

                        <span class="fs-5"> Employment<span style="color:#00c5d0;">N</span>exus<span
                                style="color:#00c5d0;">.</span>Com</span>
                    </a>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2">Most Trusted Job Site In India.</li>
                        {{-- EmploymentNexus offers new job alerts every day, along with daily email job
                            alerts. --}}
                        <li class="mb-2">Our mission is to assist fresh graduates with employment opportunities in all
                            states
                            of India, including government and multinational companies.</li>
                        {{-- <li class="mb-2">
                            <a class="text-decoration-none" href="mailto:info@preparenext.com">
                                <i class="bi bi-envelope-fill"></i>
                                info@preparenext.com
                            </a>
                        </li> --}}

                        <!-- <li class="mb-2 mt-4">
                            <h5> Stay Connected On Mobile </h5>
                            <a class="text-decoration-none"
                                href="https://play.google.com/store/apps/details?id=com.prepare.next">
                                <img src="{{ url('/logo/playstore.png') }}" class="img-fluid" width="155" height="45"
                                    loading="lazy" alt="EmploymentNexus App On Mobile">
                            </a>
                        </li> -->

                    </ul>
                </div>
                <div class="col-sx-12 col-md-3 col-lg-3  mb-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ URL('/') }}">Home</a></li>
                        {{-- <li class="mb-2"><a href="{{ URL('/') }}">All India Goverment Jobs</a></li>
                        <li class="mb-2"><a href="{{ URL('/') }}">State Goverment Jobs</a></li>
                        <li class="mb-2"><a href="{{ URL('/') }}">Software Jobs</a></li>
                        <li class="mb-2"><a href="{{ URL('/') }}">Engineering Jobs</a></li> --}}
                        <li class="mb-2"><a href="{{ URL('/jobs-blog') }}">Carrer Advice</a></li>
                        <li class="mb-2"><a href="{{ URL('/jobs-video') }}">Videos</a></li>
                        <li class="mb-2"><a href="{{ URL('/about-us') }}">About Us</a></li>
                        {{-- <li class="mb-2"><a href="{{ URL('/') }}">Contact Us</a></li> --}}
                    </ul>
                </div>


                {{-- @php
                    $branchjob = App\Models\Admin\Job\Jobmaster\Branchjob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($branchjob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Branch</h5>
                        <ul class="list-unstyled">
                            @foreach ($branchjob as $eachbranchjob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['branch', $eachbranchjob->slug]) }}">{{ $eachbranchjob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                @php
                    $categoryjob = App\Models\Admin\Job\Jobmaster\Categoryjob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($categoryjob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Category</h5>
                        <ul class="list-unstyled">
                            @foreach ($categoryjob as $eachcategoryjob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['branch', $eachcategoryjob->slug]) }}">{{ $eachcategoryjob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $companyjob = App\Models\Admin\Job\Jobmaster\Companyjob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($companyjob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Company</h5>
                        <ul class="list-unstyled">
                            @foreach ($companyjob as $eachcompanyjob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['role', $eachcompanyjob->slug]) }}">{{ $eachcompanyjob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @php
                    $coursejob = App\Models\Admin\Job\Jobmaster\Coursejob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($coursejob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Education</h5>
                        <ul class="list-unstyled">
                            @foreach ($coursejob as $eachcoursejob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['course', $eachcoursejob->slug]) }}">{{ $eachcoursejob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                @php
                    $designationjob = App\Models\Admin\Job\Jobmaster\Designationjob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($designationjob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Designation</h5>
                        <ul class="list-unstyled">
                            @foreach ($designationjob as $eachdesignationjob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['designation', $eachdesignationjob->slug]) }}">{{ $eachdesignationjob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $languagejob = App\Models\Admin\Job\Jobmaster\Languagejob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($languagejob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Language</h5>
                        <ul class="list-unstyled">
                            @foreach ($languagejob as $eachlanguagejob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['language', $eachlanguagejob->slug]) }}">{{ $eachlanguagejob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                @php
                    $rolejob = App\Models\Admin\Job\Jobmaster\Rolejob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($rolejob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Role</h5>
                        <ul class="list-unstyled">
                            @foreach ($rolejob as $eachrolejob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['role', $eachrolejob->slug]) }}">{{ $eachrolejob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif




                @php
                    $skilljob = App\Models\Admin\Job\Jobmaster\Skilljob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($skilljob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Skill</h5>
                        <ul class="list-unstyled">
                            @foreach ($skilljob as $eachskilljob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['skill', $eachskilljob->slug]) }}">{{ $eachskilljob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @php
                    $tagjob = App\Models\Admin\Job\Jobmaster\Tagjob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($tagjob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Tag</h5>
                        <ul class="list-unstyled">
                            @foreach ($tagjob as $eachtagjob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['tag', $eachtagjob->slug]) }}">{{ $eachtagjob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                @php
                    $typwjob = App\Models\Admin\Job\Jobmaster\Typejob::where('active', true)
                        ->where('is_footer', true)
                        ->get();
                @endphp
                @if ($typwjob->isNotEmpty())
                    <div class="col-sx-12 col-md-3 col-lg-3 mb-3">
                        <h5>Type</h5>
                        <ul class="list-unstyled">
                            @foreach ($typwjob as $eachtypwjob)
                                <li class="mb-2"><a
                                        href="{{ route('jobtype', ['typw', $eachtypwjob->slug]) }}">{{ $eachtypwjob->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
        <div class="mt-auto py-3 bg-light shadow-lg">
            <div class="container">
                <div class="text-muted clearfix">
                    <span class="float-start">
                        Copyright © 2025 EmploymentNexus.Com All Rights
                        Reserved.
                    </span>
                    <span class="float-end">
                        <a class="text-decoration-none" target="_blank"
                            href="https://www.youtube.com/">
                            <i class="bi bi-youtube m-1" style="font-size: 1.5rem; color: #ff0000;"></i>
                        </a>
                        <a class="text-decoration-none" target="_blank"
                            href="https://www.facebook.com/">
                            <i class="bi bi-facebook m-1" style="font-size: 1.5rem; color: #3b5998;"></i>
                        </a>
                        <a class="text-decoration-none" target="_blank"
                            href="https://www.instagram.com/">
                            <i class="bi bi-instagram m-1" style="font-size: 1.5rem; color: #3f729b;"></i>
                        </a>
                        <a class="text-decoration-none" target="_blank"
                            href="https://www.linkedin.com/">
                            <i class="bi bi-linkedin m-1" style="font-size: 1.5rem; color: #0082ca;"></i>
                        </a>
                        <!-- <a class="text-decoration-none" target="_blank"
                            href="https://www.reddit.com/user/PrepareNext_Com">
                            <i class="bi bi-reddit m-1" style="font-size: 1.5rem; color: #ff4500;"></i>
                        </a> -->
                        <a class="text-decoration-none" target="_blank" href="https://t.me/">
                            <i class="bi bi-telegram m-1" style="font-size: 1.5rem; color: #3996c8;"></i>
                        </a>
                        <a class="text-decoration-none" target="_blank" href="https://twitter.com/">
                            <i class="bi bi-twitter m-1" style="font-size: 1.5rem; color: #55acee;"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </footer>
</div>
