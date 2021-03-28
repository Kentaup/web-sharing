@if(empty($keyword))
    {{$keyword = null}}
@endif
<form method="GET" action="{{ route('pages.search')}}">
  <div class="form-group row">
      <div class="col-8">
        <input name="keyword" type="text" class="form-control" placeholder="キーワードを入力" value="{{ $keyword }}">
      </div>
      <div class="col-4">
        <button type="submit" class="btn btn-primary ">検索</button>
      </div>
  </div>
  @if(isset($keyword))
    <div class="row">
      <p class="card-text">検索ワード：{!! $keyword !!}</p>
    </div>
  @endif
</form>