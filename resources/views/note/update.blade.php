@extends('layouts.mainbase')

@section('title','note')
@section('subtitle','ノート編集')


@section('header')
@endsection

@section('side_main')
@endsection

@section('main_content')
<div class="center">

    <h1>このページはノートの編集を行うページです。</h1>
    <div>
        <a href="/note/delete?id={{ $form->id }}">このノートを削除する</a>
        <form id="note-form" action="/note/update" method="post">
            {{ csrf_field() }}
            <div>
                {{-- <button type="submit" value="send">登録</button> --}}
                <div class="note-btn" data-method="update/ajax">編集を登録</div>
            </div>
            <div>
                <input type="hidden" name="id" value="{{ $form->id }}">
                @if($errors->first('text') !== null)
                    <p class="error_msg">{{ $errors->first('text') }}</p>
                @endif
                <label>内容</label>

                <textarea id="summernote" name="textnote" >
                    @if(0 !== strlen ($form->textnote))
                        {{ $form->textnote }}
                    @else
                        {{ $form->text }}
                    @endif
                </textarea>
            </div>

        </form>
    </div>
</div>

@endsection


@section('footer')
@endsection

