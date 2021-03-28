@if (count($reviews) > 0)
<!--評価平均-->
<!--{!! $star_sum = 0 !!}-->
@foreach ($reviews as $review)
    <!--{!! $star_sum += $review->stars !!}-->
@endforeach
<!--{!! $star_ave = 1+$star_sum/count($reviews) !!}-->
<div class="col-5">
    <div class="card mb-2  text-warning bg-light">
      <div class="card-body">
        <h3 class="mb-1">　<i class="far fa-star"></i>　平均評価：{!! nl2br(e($star_ave)) !!} </h3>
      </div>
    </div> 
</div>

<ul class="list-unstyled">
        @foreach ($reviews as $review)
            <div class="media mb-3 card">
                    <div class="row card-body">
                        <div class="media-body">
                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                            <img class="mr-2 rounded" src="{{ Gravatar::get($review->user->email, ['size' => 50]) }}" alt="">
                            {{-- ユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show', $review->user->name, ['user' => $review->user->id]) !!}
                            <span class="text-muted"> posted at {{ $review->created_at }} </span>
                            <p class="mb-0">
                                <i class="far fa-star"></i>
                                {!! nl2br(e($review->stars+1)) !!} 
                            </p>
                            <p class="mb-0">{!! nl2br(e($review->comment)) !!} </p>
                        </div>
                    </div>
            </div>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $reviews->links() }}
@else
    <h1>まだレビューがありません</h1>
@endif