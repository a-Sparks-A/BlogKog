<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Markedia - Marketing Blog Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/version/marketing.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .category-selector-wrapper {
            margin-bottom: 30px;
        }

        .admin-post-actions {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .admin-post-actions .btn {
            padding: 8px 15px;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        @include('admin.layouts.header')
        <section id="cta" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 align-self-center">
                        <h2>A digital marketing blog</h2>
                        <p class="lead"> Aenean ut hendrerit nibh. Duis non nibh id tortor consequat cursus at
                            mattis felis. Praesent sed lectus et neque auctor dapibus in non velit. Donec
                            faucibus
                            odio semper risus rhoncus rutrum. Integer et ornare mauris.</p>
                        <a href="#" class="btn btn-primary">Try for free</a>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="newsletter-widget text-center align-self-center">
                            <h3>Subscribe Today!</h3>
                            <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                            <form class="form-inline" method="post">
                                @csrf
                                <input type="text" name="email" placeholder="Add your email here.." required
                                    class="form-control" />
                                <input type="submit" value="Subscribe" class="btn btn-default btn-block" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">

                            @if (isset($allCategories) && $allCategories->count() > 0)
                                <div class="category-selector-wrapper">
                                    <form>
                                        <div class="form-group">
                                            <label for="category_select">View posts by category:</label>
                                            <select name="category_id" id="category_select" class="form-control"
                                                onchange="if (this.value) window.location.href=this.value;">
                                                <option value="{{ url('/') }}">Все категории</option>
                                                @foreach ($allCategories as $catItem)
                                                    <option
                                                        value="{{ route('category.show', ['id' => $catItem->id]) }}"
                                                        {{ isset($currentCategory) && $currentCategory->id == $catItem->id ? 'selected' : '' }}>
                                                        {{ $catItem->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            <div class="blog-custom-build">
                                @if (isset($posts) && $posts->count() > 0)
                                    @foreach ($posts as $p)
                                        <div class="blog-box wow fadeIn">
                                            <div class="post-media">
                                                <a href="{{ route('posts.single', ['id' => $p->id]) }}"
                                                    title="{{ $p->title }}">
                                                    <img src="{{ $p->getImage() }}" alt="{{ $p->title }}"
                                                        class="img-fluid">
                                                    <div class="hovereffect">
                                                        <span></span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="blog-meta big-meta text-center">
                                                <div class="post-sharing">
                                                    <ul class="list-inline">
                                                        <li><a href="#" class="fb-button btn btn-primary"><i
                                                                    class="fa fa-facebook"></i> <span
                                                                    class="down-mobile">Share on Facebook</span></a>
                                                        </li>
                                                        <li><a href="#" class="tw-button btn btn-primary"><i
                                                                    class="fa fa-twitter"></i> <span
                                                                    class="down-mobile">Tweet on Twitter</span></a></li>
                                                        <li><a href="#" class="gp-button btn btn-primary"><i
                                                                    class="fa fa-google-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h4><a href="{{ route('posts.single', ['id' => $p->id]) }}"
                                                        title="{{ $p->title }}">{{ $p->title }}</a></h4>
                                                <p>{{ Str::limit(strip_tags($p->content ?? ''), 200) }}</p>
                                                @auth
                                                    @if (Auth::user()->isAdmin())
                                                        <div class="admin-post-actions">
                                                            <a href="{{ route('posts.edit', ['post' => $p->id]) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                            <form action="{{ route('posts.destroy', ['post' => $p->id]) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash-o"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endauth
                                                @if ($p->category)
                                                    <small><a
                                                            href="{{ route('category.show', ['id' => $p->category->id]) }}"
                                                            title="{{ $p->category->title }}">{{ $p->category->title }}</a></small>
                                                @endif
                                                <small><a href="{{ route('posts.single', ['id' => $p->id]) }}"
                                                        title="">{{ $p->created_at ? $p->created_at->format('d F, Y') : 'N/A Date' }}</a></small>
                                                <small><a href="#" title="">by Admin</a></small>
                                                <small><a href="#" title=""><i class="fa fa-eye"></i>
                                                        {{ $p->views ?? 0 }}</a></small>
                                            </div>
                                        </div>
                                        <hr class="invis">
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" role="alert">
                                        No posts found. Please check back later!
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    @if (isset($posts) && $posts->count() > 0)
                                        {{ $posts->links('pagination::bootstrap-4') }}
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                    @include('admin.layouts.sidebar')
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Recent Posts</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    @forelse ($recentPosts ?? [] as $recentPost)
                                        <a href="{{ route('posts.single', ['id' => $recentPost->id]) }}"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ $recentPost->getImage() }}"
                                                    alt="{{ $recentPost->title }}" class="img-fluid float-left">
                                                <h5 class="mb-1">{{ $recentPost->title }}</h5>
                                                <small>{{ $recentPost->created_at ? $recentPost->created_at->format('d M, Y') : 'N/A Date' }}</small>
                                            </div>
                                        </a>
                                    @empty
                                        <p>No recent posts available.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Posts</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    @forelse ($popularPosts ?? [] as $popularPost)
                                        <a href="{{ route('posts.single', ['id' => $popularPost->id]) }}"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ $popularPost->getImage() }}"
                                                    alt="{{ $popularPost->title }}" class="img-fluid float-left">
                                                <h5 class="mb-1">{{ $popularPost->title }}</h5>
                                                <span class="rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </span>
                                            </div>
                                        </a>
                                    @empty
                                        <p>No popular posts available.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Categories</h2>
                            <div class="link-widget">
                                <ul>
                                    @forelse ($allCategories ?? [] as $category)
                                        <li><a href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->title }}
                                                <span>({{ $category->posts_count ?? ($category->posts ? $category->posts->count() : 0) }})</span></a>
                                        </li>
                                    @empty
                                        <li>No categories available.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <br>
                        <div class="copyright">&copy; {{ date('Y') }} Markedia. Design: <a
                                href="http://html.design">HTML Design</a>.</div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="dmtop">Scroll to Top</div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
