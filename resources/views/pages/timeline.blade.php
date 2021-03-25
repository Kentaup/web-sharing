@if (count($pages) > 0)
    <ul class="list-unstyled">
        @foreach ($pages as $page)
            <div class="media mb-3 card">
                <a href="pages/{{$page->id}}">
                    <div class="row card-body">
                        <div class="col-6 media-body">
                            <img src="{!! $page->thumbnail !!}" width="128" height="128" />
                            <p class="mb-0"> タイトル：{!! nl2br(e($page->title)) !!} </p>
                        </div>
                        <div class="col-6 media-body">
                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                            <img class="mr-2 rounded" src="{{ Gravatar::get($page->user->email, ['size' => 50]) }}" alt="">
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show', $page->user->name, ['user' => $page->user->id]) !!}
                            <span class="text-muted"> posted at {{ $page->created_at }} </span>
                        
                            <p class="mb-0"> 投稿者コメント{!! nl2br(e($page->content)) !!} </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $pages->links() }}
@else
    <h1>投稿がありません</h1>
@endif