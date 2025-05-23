<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="marketing-index.html"><img src="{{ asset('images/version/market-logo.png') }}"
                    alt=""></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/all-category/1">Категории</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/all-tags/1">Теги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts') }}">Блог</a>
                    </li>
                </ul>
                <form class="form-inline" method="GET" action="{{ route('search') }}">
                    <input name="s" class="form-control mr-sm-2" @error('s') is-invalid @enderror type="text"
                        placeholder="How may I help?" required value="{{ request('s') }}">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->
