@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="WEBSITE ENQUIRY" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websiteenquiry.index') }}">Website</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('websiteenquiry.index') }}">Website Enquiry</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>


 <x-admin.layouts.adminindex>

    <x-slot name="title">
    Enquiry
    </x-slot>

    <x-slot name="action">

    </x-slot>

    <x-slot name="tableid">
        ajaxenquiry
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>FIRST NAME</th>
        <th>LAST NAME</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>MESSAGE</th>
        <th>TYPE</th>
        <th>CREATED BY</th>
        <th>CREATED AT</th>
        <!-- <th>ACTION</th> -->
    </x-slot>

</x-admin.layouts.adminindex>


@endsection
@section('footerSection')
<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxenquiry').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('websiteenquiry.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'fname', name: 'fname' },
            { data: 'lname', name: 'lname' },
            { data: 'phone', name: 'phone' },
            { data: 'email', name: 'email' },
            { data: 'message', name: 'message' },
            { data: 'type', name: 'type' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            // { data: 'action', name: 'action',  orderable: false, searchable: false },
        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>

<script>
  $("#website-collapse").addClass('show');
  $("#websiteenquiry").css({"background-color": "#00c5d0"});
  $("#website").css({"background-color": "#00c5d0"});
</script>
@endsection
