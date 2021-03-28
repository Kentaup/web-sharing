<div class="my-3">
    <div class="card text-center bg-light mb-3">
            <div class="card-body">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a href="{{ route('welcome') }}" class="nav-link {{ Request::routeIs('welcome') ? 'active' : '' }}">
                        全ての投稿
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pages.mine') }}" class="nav-link {{ Request::routeIs('pages.mine') ? 'active' : '' }}">
                        自分の投稿
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    
</div>