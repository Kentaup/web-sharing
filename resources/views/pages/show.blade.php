@extends('layouts.app')

@section('content')
<div class="row my-3">
    <a href="/">
        <button type="button" class="btn btn-primary">戻る</button>
    </a>
</div>
<div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img class="bd-placeholder-img" width="100%" height="250" src="{!! $page->thumbnail !!}" >
    </div>
    <div class="col-md-8">
        <div class="card-body row">
            <div class="col-6">
                <h5 class="card-title">{!! nl2br(e($page->title)) !!} </h5>
                <p class="card-text"> URL:
                    <a href="{{$page->url}}" target="blank"> {!! nl2br(e($page->url)) !!} </a>
                </p>
                <p class="card-text"> 投稿者コメント:<br>{!! nl2br(e($page->content)) !!} </p>
                <p class="card-text"><small class="text-muted">posted at {{ $page->created_at }}</small></p>
            </div>
        <div class="col-6 media-body">
            <p class="card-text">投稿者<p>
            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
            <img class="mr-2 rounded" src="{{ Gravatar::get($page->user->email, ['size' => 40]) }}" alt="">
            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
            {!! link_to_route('users.show', $page->user->name, ['user' => $page->user->id]) !!}
            
            {{-- 投稿削除ボタン--}}
            @if (Auth::id() == $page->user_id)
                {!! Form::open(['route' => ['pages.destroy', $page->id], 'method' => 'delete']) !!}
                {!! Form::submit('投稿を削除する', ['class' => 'btn btn-danger btn-sm mx-3']) !!}
                {!! Form::close() !!}
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div>
    {{-- レビュー一覧 --}}
    @include('reviews.reviews')
</div>
<div class="row">
    {{-- レビュー投稿フォーム --}}
    @include('reviews.form')
</div>

@endsection