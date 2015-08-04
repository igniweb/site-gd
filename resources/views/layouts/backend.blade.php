<!doctype html>
<html lang="{{ app('config')->get('locale') }}">
<head>
    <meta charset="utf-8">
    <title>{{ trans('admin.title') }}</title>
    {!! app('assets')->styles() !!}
</head>
<body>
    @yield('main')
    {!! app('assets')->scripts() !!}
    @yield('scripts')
</body>
</html>
