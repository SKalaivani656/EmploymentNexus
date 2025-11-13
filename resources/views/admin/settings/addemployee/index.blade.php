@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="ADD USER" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('settings') }}">Settings</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('addemployee.index') }}">Add User</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Index</li>
    </x-admin.layouts.adminbreadcrumb>


    <x-admin.layouts.adminindex>

        <x-slot name="title">
            ADD USER
        </x-slot>

        <x-slot name="action">
            @can('addemployee-create')
                <a class="btn btn-sm btn-primary shadow float-end" href="{{ route('addemployee.create') }}"
                    role="button">Create</a>
            @endcan
        </x-slot>

        <x-slot name="tableid">
            ajaxaddemployee
        </x-slot>

        <x-slot name="tableheader">
            <th>ID</th>
            <th>EMP NAME</th>
            <th>EMAIL</th>
            <th>STATUS</th>
            <th>CREATED BY</th>
            <th>CREATED AT</th>
            <th>ACTION</th>
        </x-slot>

    </x-admin.layouts.adminindex>


@endsection
@section('footerSection')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ajaxaddemployee').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    "ajax": {
                        "url": '{!! route('addemployee.index') !!}',
                        'headers': {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        "type": "GET"
                    },
                    columns: [{
                            data: 'uniqid',
                            name: 'uniqid'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'is_accountactive',
                            name: 'is_accountactive'
                        },
                        {
                            data: 'created_by',
                            name: 'created_by'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                })
                .columns.adjust()
                .responsive.recalc();
        });

    </script>
    <script>
        $("#settings").css({
            "background-color": "#00c5d0"
        });

    </script>
@endsection
