@extends('layouts.backend')

@section('main')
<pre><?php
print_r($request->ip());
echo PHP_EOL;
print_r($request->route());
echo PHP_EOL;
print_r($request->url());
?></pre>
@stop
