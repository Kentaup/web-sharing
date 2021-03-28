@if (count($pages) > 0)
    <ul class="list-unstyled">
        @foreach ($pages as $page)
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <a href="{{ route('pages.show',['page'=>$page->id]) }}">
                        <img class="bd-placeholder-img" width="100%" src="{!! $page->thumbnail !!}" >
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body row">
                        <div class="col-6">
                            <a href="{{ route('pages.show',['page'=>$page->id]) }}">
                                <h5 class="card-title">{!! nl2br(e($page->title)) !!} </h5>
                                <p class="card-text"><small class="text-muted">posted at {{ $page->created_at }}</small></p>
                            </a>
                        </div>
                        <div class="col-6 media-body">
                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                            <img class="mr-2 rounded" src="{{ Gravatar::get($page->user->email, ['size' => 40]) }}" alt="">
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show', $page->user->name, ['user' => $page->user->id]) !!}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $pages->links() }}
@else
    <h1>投稿がありません</h1>
@endif