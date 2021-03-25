{!! Form::open(['route' => 'reviews.store']) !!}
    <div class="form-group">
        {!! Form::hidden('page_id',$page->id) !!}
        星：
        {!! Form::select('stars', [1,2,3,4,5],old('star'),['placeholder' => '選択してください']) !!}
        <p>コメント：</p>
        {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '2']) !!}
        
        {!! Form::submit('レビュー投稿', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}