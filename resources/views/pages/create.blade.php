@extends('layouts.app')

@section('content')
<div class="row my-3">
    <a href="/">
        <button type="button" class="btn btn-primary">戻る</button>
    </a>
</div>

    <h1>新規投稿</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($page, ['route' => 'pages.store']) !!}
                <div class="form-group">
                    {!! Form::label('url', 'URL:') !!}
                    {!! Form::text('url', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'コメント:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿する', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection