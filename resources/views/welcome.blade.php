@extends('layouts.app')

@section('content')
    @if (Auth::check())
    <div class="row mt-3">
        <div class="col-sm-4">
            {!! link_to_route('pages.create', '投稿', [], ['class' => 'btn btn-success w-100 my-2']) !!}
            {{-- サイドバー --}}
            @include('commons.sidebar')
        </div>
        <div class="col-sm-8">
            <div class="row">
                {{-- タイムライン --}}
                @include('pages.timeline')
            </div>
        </div>
        
    </div>
        
    @else
        @include('auth.login')
    @endif
@endsection