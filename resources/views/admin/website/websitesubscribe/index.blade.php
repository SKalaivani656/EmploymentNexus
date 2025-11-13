@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="WEBSITE SUBSCRIBE" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('websitesubscribe.index') }}">Website</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a class="text-decoration-none" href="{{ route('websitesubscribe.index') }}">Website Subscribe</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Index</li>
    </x-admin.layouts.adminbreadcrumb>


    <x-admin.layouts.adminindex>

        <x-slot name="title">
            SUBSCRIBE
        </x-slot>

        <x-slot name="action">

        </x-slot>

        <x-slot name="tableid">
            ajaxsubscribe
        </x-slot>

        <x-slot name="tableheader">
            <th>ID</th>
            <th>FIRST NAME</th>
            <th>EMAIL</th>
            <th>CREATED AT</th>
            <!-- <th>ACTION</th> -->
        </x-slot>

    </x-admin.layouts.adminindex>


@endsection
@section('footerSection')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ajaxsubscribe').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    "ajax": {
                        "url": '{!! route('websitesubscribe.index') !!}',
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
                            data: 'fname',
                            name: 'fname'
                        },

                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        // {
                        //     data: 'action',
                        //     name: 'action',
                        //     orderable: false,
                        //     searchable: false
                        // },
                    ]
                })
                .columns.adjust()
                .responsive.recalc();
        });

    </script>

    <script>
        $("#website-collapse").addClass('show');
        $("#websitesubscribe").css({
            "background-color": "#00c5d0"
        });
        $("#website").css({
            "background-color": "#00c5d0"
        });

    </script>
@endsection
