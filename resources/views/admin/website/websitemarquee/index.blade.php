@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="WEBSITE MARQUEE" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websitemarquee.index') }}">Website</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websitemarquee.index') }}">WebsiteMarquee</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>


 <x-admin.layouts.adminindex>

    <x-slot name="title">
    MARQUEE
    </x-slot>

    <x-slot name="action">
        <a class="btn btn-sm btn-primary shadow float-end" href="{{ route('websitemarquee.create') }}" role="button">Create</a>
    </x-slot>

    <x-slot name="tableid">
        ajaxrmarquee
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>MARQUEE</th>
        <th>CREATED BY</th>
        <th>CREATED AT</th>
        <th>ACTION</th>
    </x-slot>

</x-admin.layouts.adminindex>


@endsection
@section('footerSection')
<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxrmarquee').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('websitemarquee.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'marquee', name: 'marquee' },
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
  $("#website-collapse").addClass('show');
  $("#websitemarquee").css({"background-color": "#00c5d0", "margin-top" : "2px"});
  $("#website").css({"background-color": "#00c5d0"});
</script>
@endsection
