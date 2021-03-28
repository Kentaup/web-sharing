@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col-sm-1">
        <a href="/">
            <button type="button" class="btn btn-primary">戻る</button>
        </a>
    </div>
    <div class="col-sm-11">
        <div class="card text-center bg-light mb-3">
            <div class="card-body">
                <h5 class="card-title">ユーザ一覧</h5>
            </div>
        </div>
        @if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
        <div class="card mb-3">
            <div class="card-body">
                <li class="media">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        {{-- ユーザ詳細ページへのリンク --}}
                        <p>{!! link_to_route('users.show', 'View profile', ['user' => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
            </div>
        </div>
            
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
    </div>
</div>
    
    
@endif
@endsection