<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

    <!-- POST時のCSRF対策 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Spot Journal | @yield('title')</title>
</head>
<body>

    {{-- @section('header')
        <header class="header_main">
        </header> --}}

    <div class="wrap_content">
        @section('side_main')
            @component('components.sidebar')
            @endcomponent

        @section('main_content')
        <main class="main_content">
            {{-- <h2>@yield('subtitle')</h2> --}}
            @yield('main_content')
        </main>
    </div><!-- END wrap_content -->

    @section('footer')
    <footer class="footer_main">
    </footer>
    @yield('js-scripts')
    <script src="{{ asset('js/main.js') }}" charset="utf-8"></script>

</body>
</html>