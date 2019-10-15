@extends('layouts.mainbase')

@section('title','note')
@section('subtitle','ゴミ箱')


@section('header')
@endsection

@section('side_main')
@endsection

@section('main_content')
<div class="list_parent">
    <div class="center">
        <div class="list_top">
            <div class="list_top_child">
                <a href="/note">
                    <i id="" class="far fa-edit note-menu" title="New Note"></i>
                </a>
            </div>
            <div class="list_top_child">
                <a href="/note/trash/">
                    <i class="far fa-trash-alt note-menu" title="ゴミ箱を見る"></i>
                </a>
            </div>
        </div>

        <div class="list_middle">
            @isset($items[0])
                @foreach ($items as $item)
                    <div class="list_child" data-id="{{ $item->id }}">
                        {{ $item->getShortText() }}
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</div>

<div class="article_view">
    <div class="center">
        <div id="display-post">
        @isset($items[0])
            <div class="list_top">
                <button id="note-restore-btn" class="btn btn-primary" onclick="noteRestore()" type="button">Restore</button>
                <button id="note-forceDelete-btn" class="btn btn-primary" onclick="noteForceDelete()" type="button">Destory</button>
            </div>
            <form id="edit-note-form" action="/note/index" method="post">
                {{ csrf_field() }}
                <div id="edit-note-field"></div>
            </form>
        @else
            <div>ゴミ箱は空です。</div>
        @endisset
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection
