@extends('layouts.backend')

@section('main')
<h2 class="ui header">
    <i class="user icon"></i>
    <div class="content">
        {{ trans('admin.user.title') }}
        <div class="sub header">{{ empty($user['id']) ? trans('admin.user.create') : $user['first_name'] . ' ' . $user['last_name'] }}</div>
    </div>
</h2>
<form action="{{ empty($user['id']) ? route('admin.user.store') : route('admin.user.update', ['id' => $user['id']]) }}" method="post" class="ui form">
    @if (!empty($user['id']))
        <input type="hidden" name="_method" value="put">
    @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <h4 class="ui header">
        <i class="code icon"></i>
        {{ trans('admin.user.application') }}
    </h4>
    <div class="field">
        <label for="user_role">{{ trans('app.user.role') }}</label>
        <select name="user[role]" id="user_role" class="ui dropdown">
            <?php foreach ($roles as $role => $label) : ?>
                <option value="{{ $role }}"{{ ($role === $user['role']) ? ' selected' : '' }}>{{ $label }}</option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="field">
        <label for="user_email">{{ trans('app.user.email') }}</label>
        <input type="text" name="user[email]" id="user_email" value="{{ $user['email'] }}">
    </div>
    <div class="two fields">
        <div class="field">
            <label for="user_password">{{ trans('app.user.password') }}</label>
            <input type="password" name="user[password]" id="user_password" placeholder="{{ !empty($user['id']) ? trans('admin.user.password') : '' }}" value="">
        </div>
        <div class="field">
            <label for="user_password_confirm">{{ trans('app.user.password_confirm') }}</label>
            <input type="password" name="user[password_confirm]" id="user_password_confirm" placeholder="{{ !empty($user['id']) ? trans('admin.user.password_confirm') : '' }}" value="">
        </div>
    </div>
    <h4 class="ui header">
        <i class="privacy icon"></i>
        {{ trans('admin.user.personal_data') }}
    </h4>
    <div class="two fields">
        <div class="field">
            <label for="user_first_name">{{ trans('app.user.first_name') }}</label>
            <input type="text" name="user[first_name]" id="user_first_name" value="{{ $user['first_name'] }}">
        </div>
        <div class="field">
            <label for="user_last_name">{{ trans('app.user.last_name') }}</label>
            <input type="text" name="user[last_name]" id="user_last_name" value="{{ $user['last_name'] }}">
        </div>
    </div>
    <button class="ui button" type="submit">{{ trans('admin.actions.validate') }}</button>
</form>
@stop

@section('scripts')
console.log('Handle frontend validation #{{ $user['id'] }}');
@stop
