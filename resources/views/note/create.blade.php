@extends('layouts.mainbase')

@section('title','note')
@section('subtitle','新規ノート')


@section('header')
@endsection

@section('side_main')
@endsection

@section('main_content')
    <div class="center">
        {{-- <h1>このページはノートの新規作成を行うページです。</h1> --}}
        <div>
            <form action="/note/create" method="post">
                {{ csrf_field() }}
                <div>
                    <button type="submit" value="send">登録</button>
                    </div>
                <div>
                    @if($errors->first('textnote') !== null)
                    <p class="error_msg">{{ $errors->first('textnote') }}</p>
                    @endif
                        <textarea id="summernote" name="textnote" >
                            {{ old('textnote') }}
                        </textarea>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('footer')
@endsection

