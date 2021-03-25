<div class="my-3">
   <table class="table">
      <tbody>
        <tr>
            <!--全ての投稿-->
            <td>{!! link_to_route('welcome', '全ての投稿', [], ['class' => 'nav-link']) !!}</td>
        </tr>
        <tr>
            <!--自分の投稿-->
            <td>{!! link_to_route('pages.mine', '自分の投稿', [], ['class' => 'nav-link']) !!}</td>
        </tr>
        <tr>
            <!--レビューした投稿-->
            {{-- <td>{!! link_to_route('pages.review', 'Users', [], ['class' => 'nav-link']) !!}</td> --}}
        </tr>
      </tbody>
    </table>
</div>