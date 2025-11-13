@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="USE ACTIVITY" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>

    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('loginlogs') }}">User Activity</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>

<x-admin.layouts.adminindex>

    <x-slot name="title">
    USER ACTIVITY
    </x-slot>
    <x-slot name="action">

   </x-slot>

    <x-slot name="tableid">
    ajaxtrackinglogs
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>NAME</th>
        <th>DETAILS</th>
        <th>CREATED AT</th>
    </x-slot>

</x-admin.layouts.adminindex>

@endsection

@section('footerSection')
<script type="text/javascript">
    $('#ajaxtrackinglogs').DataTable({
     processing: true,
     responsive: true,
     "order": [[ 0, "desc" ]],
     serverSide: true,
     "ajax": {
         "url": '{!! route('trackinglogs') !!}',
         'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
         "type": "GET"
     },
     columns: [
         { data: 'id', name: 'id' },
         { data: 'name', name: 'name' },
         { data: 'details', name: 'details' },
         { data: 'created_at', name: 'created_at' },
     ]
    }).columns.adjust().responsive.recalc();
 </script>

<script>
  $("#tracking-collapse").addClass('show');
  $("#trackinglogs").css({"background-color": "#00c5d0"});
  $("#tracking").css({"background-color": "#00c5d0"});
</script>
@endsection
