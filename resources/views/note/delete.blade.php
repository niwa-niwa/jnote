@extends('layouts.mainbase')

@section('title','note')
@section('subtitle','ノートを削除')


@section('header')
@endsection

@section('side_main')
@endsection

@section('main_content')
<div class="center">

    <h1>本当に削除しますか?</h1>

    <div>
        <a href="/note/update?id={{ $form->id }}">編集にもどる</a><br>
        <form action="/note/delete" method="post">
            {{ csrf_field() }}

            <div>
                <input type="hidden" name="id" value="{{ $form->id }}">
                {!! nl2br($form->text) !!}
            </div>
            <br>
            <div>
                <button type="submit" value="send">削除</button>
            </div>
        </form>
    </div>

</div>
@endsection


@section('footer')
@endsection

