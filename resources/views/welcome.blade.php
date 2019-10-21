<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portfolio | Note</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        {{-- <a href="{{ url('/home') }}">Home</a> --}}
                        <a href="{{ url('/note') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="color:red;">
                    {{-- Laravel --}}
                    重要  IMPORTANT
                </div>
                <h2>これはポートフォリオサイトです。This is a Portfolio</h2>
                これは開発途中のノートアプリです。<br>
                将来的にはタグ機能や検索機能を実装してEvernoteのようなノートアプリになり、他にもカレンダーやRSS機能を追加して生活が便利になるアプリになる予定です。<br><br>
                画面右上よりアカウント作成してサイトの動作をお試しください。<br><br>
                なお、<strong>このサイトは公開サイトですが、Laravel及びPHPをどれだけ使えるか見て頂くためのポートフォリオサイト</strong>となっておりますので、データは一定時間で削除されますので、<h3 style="color:red;">個人情報の入力は絶対にしないでください。</h3>
                アカウント作成にメールアドレスが必要ですが、<strong>@マークを含む架空のメールアドレスをご入力ください</strong>。
                <br>作成したアカウントはログイン後、画面左下のアイコンからご自身で削除することができます。

                <h2>This app is for study so it is not warranty to save your data.<br> Unfortunately if you could not understand Japanese, you could not use the app <br>Thank you for coming here and understanding</h2>

                <br><br>
                @if (Route::has('login'))
                <div class="center links">
                    @auth
                        {{-- <a href="{{ url('/home') }}">Home</a> --}}
                        <a href="{{ url('/note') }}" style="padding:20px; color:white; font-size: 26px; background-color:#7777f3; border-radius:10px;" >Home</a>
                    @else
                        <a href="{{ route('login') }}" style="padding:20px; color:white; font-size: 26px; background-color:#7777f3; border-radius:10px; ">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"  style="padding:20px; color:white; font-size: 26px; background-color:#7777f3; border-radius:10px; ">Register</a>
                        @endif
                    @endauth
                </div>
                @endif
                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>
    </body>
</html>
