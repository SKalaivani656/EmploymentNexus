





<aside class="text-white shadow-lg rounded" id="sidebar-wrapper">
    <div class="sidebar-brand">
        <div class="d-flex mt-3 mt-md-0" style="height: 48px;">
        <img src="{{asset('logo/logo.jpg')}}" class="ms-2" alt="" style="height: 38px;">
        <span class="fs-5 mt-1 ms-2 fw-bold fst-italic text-white" >
       Employment<span style="color:#00c5d0;">N</span>exus<span style="color:#00c5d0;">.</span>Com
       </span></div>
    </div>
    <ul class="sidebar-nav">
        @can('dashboard')
        <li class="">
            <a href="{{ route('admindashboard') }}" id="dashboard" class="nav-link text-white border-0 fw-bold">
                <i class="bi bi-speedometer me-4 fs-5"></i>Dashboard
            </a>
        </li>
        @endcan
        @can('jobmaster')
        <li>
              <a id="jobmaster" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#jobmaster-collapse" aria-expanded="false">
                    <i class="bi bi-files me-4 fs-5"></i>Job Master
                </a>

                <div class="collapse" id="jobmaster-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                    @can('branchjob-list')
                    <li>
                        <a href="{{ route('branchjob.index') }}" onclick="setPosuvnik(1)" id="branchjob" class="text-white rounded"><i class="bi bi-briefcase-fill me-4 fs-6"></i>Branch</small></a>
                    </li>
                    @endcan
                    @can('categoryjob-list')
                         <li>
                             <a href="{{ route('categoryjob.index') }}" id="categoryjob" class="text-white rounded"><i class="bi bi-archive-fill me-4 fs-6"></i><small>Category</small></a>
                        </li>
                    @endcan
                    @can('companyjob-list')
                        <li>
                            <a href="{{ route('companyjob.index') }}" id="companyjob" class="text-white rounded"><i class="bi bi-building me-4 fs-6"></i><small>Company</small></a>
                        </li>
                    @endcan
                    @can('coursejob-list')
                        <li>
                            <a href="{{ route('coursejob.index') }}" id="coursejob" class="text-white rounded"><i class="bi bi-card-heading me-4 fs-6"></i><small>Course</small></a>
                        </li>
                    @endcan
                    @can('languagejob-list')
                        <li>
                            <a href="{{ route('languagejob.index') }}" id="languagejob" class="text-white rounded"><i class="bi bi-translate me-4 fs-6"></i><small>Language</small></a>
                        </li>
                    @endcan
                    @can('skilljob-list')
                        <li>
                            <a href="{{ route('skilljob.index') }}" id="skilljob" class="text-white rounded"><i class="bi bi-clipboard-data me-4 fs-6"></i><small>Skills</small></a>
                        </li>
                    @endcan
                    @can('tagjob-list')

                        <li>
                            <a href="{{ route('tagjob.index') }}" id="tagjob" class="text-white rounded"><i class="bi bi-check-square-fill me-4 fs-6"></i><small>Tag</small></a>
                        </li>
                    @endcan
                    @can('typejob-list')
                        <li>
                            <a href="{{ route('typejob.index') }}" id="typejob" class="text-white rounded"><i class="bi bi-fonts me-4 fs-6"></i><small>Type</small></a>
                        </li>
                    @endcan
                    @can('designationjob-list')
                        <li>
                            <a href="{{ route('designationjob.index') }}" id="designationjob" class="text-white rounded"><i class="bi bi-card-list me-4 fs-6"></i><small>Designation</small></a>
                        </li>
                    @endcan
                        @can('rolejob-list')
                        <li>
                            <a href="{{ route('rolejob.index') }}" id="rolejob" class="text-white rounded"><i class="bi bi-brush-fill me-4 fs-6"></i><small>Role</small></a>
                        </li>
                        @endcan

                    </ul>
                </div>
        </li>
        @endcan
        @can('jobmiscellaneous')
        <li>
            <a id="jobmiscellaneous" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed"
            data-bs-toggle="collapse" data-bs-target="#jobnavlink-collapse" aria-expanded="false">
            <i class="bi bi-card-list me-4 fs-5"></i>Job Miscellaneous
        </a>
        @can('jobnavlink-list')
            <div class="collapse" id="jobnavlink-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                    <li><a href="{{ route('jobnavlink.index') }}" id="jobnavlink" class="text-white rounded"><i class="bi bi-shop-window me-4 fs-6"></i><small>Jobnavlink</small></a></li>
                </ul>
            </div>
         @endcan
        </li>
        @endcan
        @can('jobpost')
        <li>
            <a href="{{ route('postjob.index') }}" id="postjob" class="nav-link text-white border-0 fw-bold">
                <i class="bi bi-sliders me-4 fs-5"></i>Job Post
            </a>
        </li>
    
        @endcan
        @can('blog')
        <li>
        <a id="blog" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#blog-collapse" aria-expanded="false">
                <i class="bi bi-card-list me-4 fs-5"></i>Blog
            </a>
            <div class="collapse" id="blog-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                @can('postblog-list')
                    <li>
                        <a href="{{ route('postblog.index') }}" id="postblog" class="text-white rounded"><i class="bi bi-file-post me-4 fs-6"></i><small>Post</small></a>
                    </li>
                @endcan
                @can('categoryblog-list')
                    <li>
                        <a href="{{ route('categoryblog.index') }}" id="categoryblog" class="text-white rounded"><i class="bi bi-archive-fill me-4 fs-6"></i><small>Category</small></a>
                    </li>
                @endcan
                @can('tagblog-list')
                    <li>
                        <a href="{{ route('tagblog.index') }}" id="tagblog" class="text-white rounded"><i class="bi bi-check-square-fill me-4 fs-6"></i><small>Tag</small></a>
                    </li>
                @endcan
                </ul>
            </div>
        </li>
        @endcan



        @can('exam')
        <li>
            <a id="exam" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#exam-collapse" aria-expanded="false">
            <i class="bi bi-book-fill me-4 fs-5"></i>Exam
            </a>
            <!-- <div class="collapse" id="exam-collapse">
             <a id="" class="nav-link text-white border-0 fw-bold btn btn-toggle align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#exammaster-collapse" aria-expanded="false">
                <i class="bi bi-card-list me-4 fs-5"></i>Master
             </a>
             </div> -->
             @can('competitiveexam-list')
            <div class="collapse" id="exam-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                    <li><a href="{{ route('competitiveexam.index') }}" id="competitiveexam" class="text-white rounded"><i class="bi bi-chat-right-fill me-4 fs-6"></i><small>Competitive Exam</small></a></li>
                </ul>
            </div>
            @endcan

        </li>
        @endcan

        @can('website')

        <li>
            <a id="website" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#website-collapse" aria-expanded="false">
            <i class="bi bi-globe me-4 fs-5"></i>Website
            </a>


            <div class="collapse" id="website-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                @can('marquee-list')
                    <li>
                        <a href="{{ route('websitemarquee.index') }}" id="websitemarquee" class="text-white rounded"><i class="bi bi-bookmarks-fill  me-4 fs-6"></i><small>Marquee</small></a>
                    </li>
                @endcan
                @can('enquiry-list')
                    <li>
                        <a href="{{ route('websiteenquiry.index') }}" id="websiteenquiry" class="text-white rounded"><i class="bi bi-question-circle-fill me-4 fs-6"></i><small>Enquiry</small></a>
                    </li>
                @endcan
                @can('subscribe-list')
                    <li>
                        <a href="{{ route('websitesubscribe.index') }}" id="websitesubscribe" class="text-white rounded"><i class="bi bi-bell-fill me-4 fs-6"></i><small>Subscribe</small></a>
                    </li>
                @endcan
                </ul>
            </div>


        </li>
        @endcan


        @can('video')

        <li>
            <a id="video" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#video-collapse" aria-expanded="false">
            <i class="bi bi-camera-video me-4 fs-5"></i>Video
            </a>

            <div class="collapse" id="video-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                @can('postvideo-list')
                    <li>
                        <a href="{{ route('postvideo.index') }}" id="postvideo" class="text-white rounded"><i class="bi bi-camera-video-fill me-4 fs-6"></i><small>Video Post</small></a>
                    </li>
                 @endcan
                 @can('categoryvideo-list')
                    <li>
                        <a href="{{ route('categoryvideo.index') }}" id="categoryvideo" class="text-white rounded"><i class="bi bi-film me-4 fs-6"></i><small>Video Category </small></a>
                    </li>
                @endcan
                @can('tagvideo-list')
                    <li>
                        <a href="{{ route('tagvideo.index') }}" id="tagvideo" class="text-white rounded"><i class="bi bi-play-circle-fill me-4 fs-6"></i><small>Video Tags</small></a>
                    </li>
                @endcan
                </ul>
            </div>

        </li>
      @endcan

      @can('settings')
        <li>
            <a href="{{ route('settings') }}" id="settings" class="nav-link text-white border-0 fw-bold">
                <i class="bi bi-sliders me-4 fs-5"></i>Settings
            </a>
        </li>
    @endcan
    @can('tracking')
        <li>
            <a id="tracking" class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#tracking-collapse" aria-expanded="false">
                <i class="bi bi-card-list me-4 fs-5"></i>Tracking
            </a>
            <div class="collapse" id="tracking-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                @can('loginifo-list')
                    <li>
                        <a href="{{ route('loginlogs') }}" id="loginlogs" class="text-white rounded"><i class="bi bi-shop-window me-4 fs-6"></i><small>Login Info</small></a>
                    </li>
                @endcan
                @can('useractivity-list')
                
                    <li>
                        <a href="{{ route('trackinglogs') }}" id="trackinglogs" class="text-white rounded"><i class="bi bi-shop-window me-4 fs-6"></i><small>User Activity</small></a>
                    </li>
                @endcan
                </ul>
            </div>
        </li>
     @endcan
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="logout" class="nav-link text-white border-0 text-danger fw-bold">
                <i class="bi bi-power me-4 fs-5"></i>Logout
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </ul>
  </aside>
