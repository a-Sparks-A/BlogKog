@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Search: {{ $s }}</h2>
                </div><!--end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Search</li>
                    </ol>
                </div><!--end col -->
            </div><!--end row -->
        </div><!--end container -->
    </div><!--end page-title -->
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="blog-box">
                        @if ($post->thumbnail)
                            <div class="post-media">
                                <a href="{{ route('admin.posts.show', $post->slug) }}" title="">
                                    <img src="{{ $post->getImage() }}" alt="{{ $post->title }}" class="img-fluid">
                                    <div class="hovereffect"></div>
                                </a>
                            </div>
                        @endif
                        <div class="blog-meta big-meta">
                            <h4><a href="{{ route('posts.single', $post->id) }}" title="">{{ $post->title }}</a></h4>
                            <p>{{ Str::limit($post->description, 120) }}</p>
                            @if ($post->category)
                                <small><a href="{{ route('category.show', ['id' => $post->category->id]) }}"
                                        title="">{{ $post->category->title }}</a></small>
                            @endif
                            <small>{{ $post->created_at->format('d M, Y') }}</small>
                        </div>
                    </div>
                    <hr class="invis">
                @endforeach
            @else
                По вашему запросу ничего не найдено!
            @endif
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page Navigation">
                {{ $posts->appends(['s' => request()->s])->links() }}
            </nav>
        </div>
    </div>
@endsection
