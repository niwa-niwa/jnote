@extends('layouts.mainbase')

@section('title','note')
{{-- @section('subtitle','直近のノート') --}}

@section('header')
@endsection

@section('side_main')
@endsection

@section('main_content')
<div class="list_parent">
    <div class="center">
        <div class="list_top">
            <div class="list_top_child">
                <i id="new-note-icon" class="far fa-edit note-menu" title="New Note"></i>
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
                <button id="note-edit-btn" class="btn btn-primary" onclick="noteEdit()" type="button">Edit</button>
                <button id="note-save-btn" class="btn btn-primary" onclick="noteSave()" type="button">Save</button>
                <button id="note-delete-btn" class="btn btn-primary" onclick="noteDelete()" type="button">Delete</button>
            </div>
            <form id="edit-note-form" action="/note/index" method="post">
                {{ csrf_field() }}
                <div id="edit-note-field"></div>
            </form>
        @else
            <p>ノートはありません。</p>
        @endisset
        </div>

        <div id="new-post" style="display:none;">
            <div class="list_top">
                <button id="note-cancel-btn" class="btn btn-primary" onclick="noteCancel()" type="button">Cancel</button>
                <button id="note-create-btn" class="btn btn-primary" onclick="noteCreate()" type="button">Save</button>
            </div>
            <form id="new-note-form" >
                {{ csrf_field() }}
                <div>
                    @if($errors->first('textnote') !== null)
                        <p class="error_msg">{{ $errors->first('textnote') }}</p>
                    @endif
                        <textarea id="new-notearea" name="textnote" >
                            {{ old('textnote') }}
                        </textarea>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection