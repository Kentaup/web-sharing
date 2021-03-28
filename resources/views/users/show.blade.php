@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
            @if (Auth::id() == $user->id)
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('アカウントを削除する', ['class' => 'btn btn-danger btn-sm mt-3']) !!}
                {!! Form::close() !!}
            @endif
        </aside>
        <div class="col-sm-8">
            <div class="card text-center text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">ユーザの投稿一覧</h5>
                </div>
            </div>
            {{-- 自分の投稿一覧 --}}
            @include('pages.timeline')
        </div>
    </div>
@endsection