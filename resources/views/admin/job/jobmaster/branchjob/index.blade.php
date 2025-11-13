@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="BRANCH" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('branchjob.index') }}">Master</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('branchjob.index') }}">Branch</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>


 <x-admin.layouts.adminindex>

    <x-slot name="title">
        BRANCH
    </x-slot>

    <x-slot name="action">
        @can('branchjob-create')
        <a class="btn btn-sm btn-primary shadow float-end"  href="{{ route('branchjob.create') }}" role="button">Create</a>
        @endcan
    </x-slot>

    <x-slot name="tableid">
        ajaxbranch
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>BRANCH</th>
        <th>CREATED BY</th>
        <th>CREATED AT</th>
        <th>ACTION</th>
    </x-slot>

</x-admin.layouts.adminindex>


@endsection
@section('footerSection')
<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxbranch').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('branchjob.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
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
  $("#jobmaster-collapse").addClass('show');
  $("#branchjob").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#jobmaster").css({"background-color": "#00c5d0"});
</script>
@endsection