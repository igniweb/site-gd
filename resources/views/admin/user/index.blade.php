@extends('layouts.backend')

@section('main')
<h2 class="ui header">
    <i class="users icon"></i>
    <div class="content">
        {{ trans('admin.user.title') }}
        <div class="sub header">{{ trans('admin.user.subtitle') }}</div>
    </div>
</h2>
<table id="users">
    <thead>
        <tr>
            <th class="sorted ascending">{{ trans('app.user.id') }}</th>
            <th>{{ trans('admin.user.name') }}</th>
            <th>{{ trans('app.user.role') }}</th>
            <th>{{ trans('app.user.email') }}</th>
            <th>{{ trans('admin.actions.label') }}</th>
        </tr>
    </thead>
</table>
@stop

@section('scripts')
    App.datatables.setup({
        table: 'users',
        dataUrl: '{{ route("admin.user.datatable") }}',
        nonOrderableIndexes: 4
    });
@stop
