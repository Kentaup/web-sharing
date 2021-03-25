@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- 自分の投稿一覧 --}}
            @include('pages.timeline')
        </div>
    </div>
@endsection