@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="COLOR" />
@endsection

@section('main-content')
<x-admin.layouts.adminbreadcrumb>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('color.index') }}">Settings</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a class="text-decoration-none" href="{{ route('color.index') }}">Color</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
</x-admin.layouts.adminbreadcrumb>


 <x-admin.layouts.adminindex>

    <x-slot name="title">
    COLOR
    </x-slot>

    <x-slot name="action">

    </x-slot>

    <x-slot name="tableid">
        ajaxcolor
    </x-slot>

    <x-slot name="tableheader">
        <th>ID</th>
        <th>TYPE</th>
        <th>HEXA CODE</th>
        <th>DEFAULT</th>
    </x-slot>

</x-admin.layouts.adminindex>


@endsection
@section('footerSection')
<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxcolor').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('color.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { data: 'hexacode', name: 'hexacode' },
            { data: 'is_default', name: 'is_default' },

        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>

<script>
  $("#settings").css({"background-color": "#00c5d0"});
</script>
@endsection
