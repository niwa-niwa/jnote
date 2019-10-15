@extends('layouts.app')

@section('content')
<div class="container">
    This is a test
    @isset($test)
    表示結果は?
    <br>
    <br>
        @php
            dump($test)
        @endphp
    @endisset
</div>
@endsection
