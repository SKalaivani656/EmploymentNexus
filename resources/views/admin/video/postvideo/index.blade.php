@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="VIDEO POST" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postvideo.index') }}">Video</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('postvideo.index') }}">Video Post</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>


 <x-admin.layouts.adminindex>

    <x-slot name="title">
    VIDEO POST
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-primary shadow float-end" href="{{ route('postvideo.create') }}" role="button">Create</a>
    </x-slot>

    <x-slot name="tableid">
        ajaxpostvideo
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>POST</th>
        <th>CREATED BY</th>
        <th>CREATED AT</th>
        <th>ACTION</th>
    </x-slot>

</x-admin.layouts.adminindex>


@endsection
@section('footerSection')
<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxpostvideo').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('postvideo.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
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
  $("#video-collapse").addClass('show');
  $("#postvideo").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#video").css({"background-color": "#00c5d0"});
</script>
@endsection
