<!doctype html>
<html lang="{{ app('config')->get('locale') }}">
<head>
    <meta charset="utf-8">
    <title>{{ trans('admin.title') }}</title>
    {!! app('assets')->styles() !!}
</head>
<body>
    @include('layouts.backend._menu')
    <div class="ui container main-container">
        @yield('main')
    </div>
    {!! app('assets')->scripts() !!}
    <script>
        App.locales = {!! json_encode(trans('app.javascript')) !!};
        @yield('scripts')
    </script>
</body>
</html>
