@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="LOGIN LOG'S" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>

    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('loginlogs') }}">Login Log's</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminindex>

    <x-slot name="title">
    LOGIN LOG'S
    </x-slot>

    <x-slot name="action">

    </x-slot>

    <x-slot name="tableid">
    ajaxloginlogs
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>DEVICE</th>
        <th>BROWSER</th>
        <th>PLATEFORM</th>
        <th>SERVER IP</th>
        <th>CLIENT IP</th>
        <th>LOGIN STATUS</th>
        <th>CREATED AT</th>
    </x-slot>

</x-admin.layouts.adminindex>

@endsection

@section('footerSection')
<script type="text/javascript">
$('#ajaxloginlogs').DataTable({
        responsive: true,
        processing: true,
        "order": [
            [0, "desc"]
        ],
        serverSide: true,
        "ajax": {
            "url": '{!! route('loginlogs') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [{data: 'id',name: 'id'},
        {data: 'user_name',name: 'user_name'},
        {data: 'email',name: 'email'},
        {data: 'device',name: 'device'},
        {data: 'browser',name: 'browser'},
        {data: 'platform',name: 'platform'},
        {data: 'serverIp',name: 'serverIp'},
        {data: 'clientIp',name: 'clientIp'},
        {data: 'login_status',name: 'login_status'},
        {data: 'created_at',name: 'created_at'},
        ]
    })
    .columns.adjust()
    .responsive.recalc();
</script>

<script>
  $("#tracking-collapse").addClass('show');
  $("#loginlogs").css({"background-color": "#00c5d0","margin-top":"2px"});
  $("#tracking").css({"background-color": "#00c5d0"});
</script>
@endsection
