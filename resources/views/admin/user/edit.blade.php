@extends('layouts.backend')

@section('main')
<h2 class="ui header">
    <i class="users icon"></i>
    <div class="content">
        {{ trans('admin.user.title') }}
        <div class="sub header">{{ trans('admin.user.subtitle') }}</div>
    </div>
</h2>
<pre><?php print_r($user); echo PHP_EOL; print_r($roles); ?></pre>
@stop

@section('scripts')
console.log('Edit user #{{ $user['id'] }}');
@stop
