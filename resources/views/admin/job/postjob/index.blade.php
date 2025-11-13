@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="JOB POST" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>

    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postjob.index') }}"> Job Post</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>


 <x-admin.layouts.adminindex>

    <x-slot name="title">
    JOB POST
    </x-slot>

    <x-slot name="action">
    @can('postjob-create')
        <a class="btn btn-sm btn-primary shadow float-end" href="{{ route('postjob.create') }}" role="button">Create</a>
    @endcan
    </x-slot>

    <x-slot name="tableid">
        ajaxpost
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>JOB POST</th>
        <th>CREATED BY</th>
        <th>CREATED AT</th>
        <th>ACTION</th>
    </x-slot>

</x-admin.layouts.adminindex>


@endsection
@section('footerSection')
<script post="text/javascript">
    $(document).ready(function() {
        $('#ajaxpost').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('postjob.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "post": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'title', name: 'title' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action',  orderable: false, searchable: false },
        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>

    
<script>
$("#postjob").css({"background-color": "#00c5d0"});
</script>
@endsection
