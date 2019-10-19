@extends('layouts.mainbase')

@section('title','各種設定')
{{-- @section('subtitle','直近のノート') --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
@endsection

@section('header')
@endsection

@section('side_main')
@endsection

@section('main_content')
    <div class="list_parent">
        <div class="list_top">
            <h2>設定</h2>
        </div>

        <div class="list_middle">
            <div class="setting-columns">
                <p class="setting-title">アカウント</p>
            </div>
        </div>
    </div>

    <div class="article_view">
        <div class="setting-account">
            <div class="setting-columns" onclick="settingName();">
                <p class="setting-title">ユーザー名</p>
                <span class="setting-subtitle" data-setting="name">{{ $items->name }}</span>
            </div>
            <div class="setting-columns" onclick="settingMail();">
                <p class="setting-title">メールアドレス</p>
                <span class="setting-subtitle" data-setting="mail">{{ $items->email }}</span>
            </div>
            <div class="setting-columns" >
                <p class="setting-title">パスワード</p>
                <form method="POST" onsubmit="doSomething();return false;">
                    @csrf
                    <div class="form-group">
                        <label for="current">現在のパスワード</label>
                        <div>
                            <input id="current-pw" type="password" class="form-control" name="current-pw" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">新しいパスワード</label>
                        <div>
                            <input id="new-pw" type="password" class="form-control" name="new-pw" required>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm">確認パスワード</label>
                        <div>
                            <input id="confirm-pw" type="password" class="form-control" name="confirm-pw" required>
                        </div>
                    </div>
                    <div>
                    </div>
                </form>
                <button type="submit" id="btn-password" class="btn btn-primary" onclick="settingPassword();">変更</button>
            </div>
            <div class="setting-columns" onclick="settingLogout();">
                <p class="setting-title">ログアウト</p>
            </div>
            <div class="setting-columns" onclick="settingDelete();">
                <p class="setting-title">アカウントを削除</p>
            </div>
        </div>
    </div>

@endsection

@section('footer')
@endsection

@section('js-scripts')
    <script src="{{ asset('js/setting.js') }}" charset="utf-8"></script>
@endsection