@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="DASHBOARD" />
@endsection

@section('main-content')
    <div class="table-responsive p-3">
        <table id="ajaxdashboard" class="table table-bordered table-hover shadow w-100"
            style="border-radius: 3px;overflow:hidden;">
            <thead class="text-white indigo_darken_4 ">
                <tr>
                    <th>NAME</th>
                    <th>TODAY</th>
                    <th>YESTERDAY</th>
                    <th>THIS WEEK</th>
                    <th>LAST WEEK</th>
                    <th>THIS MONTH</th>
                    <th>LAST MONTH</th>
                    <th>DRAFT</th>
                    <th>TOTAL</th>

                </tr>
            </thead>
            <tbody>

                <tr>
                    <td><a class="text-decoration-none" href="{{ route('postjob.index') }}"> JOBS </a></td>
                    <td>{{ $data['todayjobs'] }}</td>
                    <td>{{ $data['yesterdayjobs'] }}</td>
                    <td>{{ $data['currentweekjobs'] }}</td>
                    <td>{{ $data['lastweekjobs'] }}</td>
                    <td>{{ $data['currentmonthjobs'] }}
                    </td>
                    <td>{{ $data['lastmonthjobs'] }}</td>
                    <td>{{ $data['draftjobs'] }}</td>
                    <td>{{ $data['totaljobs'] }}</td>
                </tr>

                <tr>
                    <td><a class="text-decoration-none" href="{{ route('postblog.index') }}"> BLOGS </a></td>
                    <td>{{ $data['todayblogs'] }}</td>
                    <td>{{ $data['yesterdayblogs'] }}</td>
                    <td>{{ $data['currentweekblogs'] }}</td>
                    <td>{{ $data['lastweekblogs'] }}</td>
                    <td>{{ $data['currentmonthblogs'] }}
                    </td>
                    <td>{{ $data['lastmonthblogs'] }}</td>
                    <td>{{ $data['draftblogs'] }}</td>
                    <td>{{ $data['totalblogs'] }}</td>
                </tr>
                <tr>
                    <td><a class="text-decoration-none" href="{{ route('postvideo.index') }}"> VIDEOS </a></td>
                    <td>{{ $data['todayvideos'] }}</td>
                    <td>{{ $data['yesterdayvideos'] }}</td>
                    <td>{{ $data['currentweekvideos'] }}</td>
                    <td>{{ $data['lastweekvideos'] }}</td>
                    <td>{{ $data['currentmonthvideos'] }}
                    </td>
                    <td>{{ $data['lastmonthvideos'] }}</td>
                    <td>{{ $data['draftvideos'] }}</td>
                    <td>{{ $data['totalvideos'] }}</td>
                </tr>




            </tbody>
        </table>
    </div>






@endsection
@section('footerSection')

    <script>
        $("#dashboard").css({
            "background-color": "#0097a7"
        });

    </script>

@endsection
