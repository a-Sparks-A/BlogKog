<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Site Metas -->
    <title>{{ $tag->title }} - Markedia</title> {{-- Более конкретный title --}}
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <!-- Animate styles for this template -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">

    <!-- Version Marketing CSS for this template -->
    <link href="{{ asset('css/version/marketing.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .page-title {
            margin-top: 100px;
        }

        .tag-selector {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        @include('admin.layouts.header')

        <div class="page-title db">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2>{{ $tag->title }} <small class="hidden-xs-down hidden-sm-down">Посты с тегом
                                "{{ $tag->title }}"</small>
                        </h2>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end page-title -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            @if (isset($allTags) && $allTags->count() > 1)
                                <div class="tag-selector">
                                    <form>
                                        <div class="form-group">
                                            <label for="tag_select">Посмотреть другой тег:</label>
                                            <select name="tag_id" id="tag_select" class="form-control"
                                                onchange="if (this.value) window.location.href=this.value;">
                                                <option value="">Выберите тег...</option>
                                                @foreach ($allTags as $tagItem)
                                                    @if ($tagItem->id != $tag->id)
                                                        <option
                                                            value="{{ route('tag.show', ['id' => $tagItem->id]) }}">
                                                            {{ $tagItem->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            <div class="blog-custom-build">
                                @if (count($posts))
                                    @foreach ($posts as $post)
                                        <div class="blog-box wow fadeIn">
                                            <div class="post-media">
                                                <a href="{{ route('posts.single', ['id' => $post->id]) }}"
                                                    title="">
                                                    <img src="{{ $post->getImage() }}" alt="{{ $post->title }}"
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
                                                <h4><a href="{{ route('posts.single', ['id' => $post->id]) }}"
                                                        title="">{{ $post->title }}</a></h4>
                                                <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                                @if ($post->category)
                                                    <small><a
                                                            href="{{ route('category.show', ['id' => $post->category->id]) }}"
                                                            title="">{{ $post->category->title }}</a></small>
                                                @endif
                                                <small><a href="{{ route('posts.single', ['id' => $post->id]) }}"
                                                        title="">{{ $post->created_at->format('d F, Y') }}</a></small>
                                                <small><a href="#" title="">by Admin</a></small>
                                                <small><a href="#" title=""><i class="fa fa-eye"></i>
                                                        {{ $post->views }}</a></small>
                                            </div>
                                        </div>
                                        <hr class="invis">
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        Постов с тегом "{{ $tag->title }}" пока нет.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    {{ $posts->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div><!-- end col-lg-8 -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        @foreach ($recentPosts ?? [] as $recentPost)
                                            <a href="{{ route('posts.single', ['id' => $recentPost->id]) }}"
                                                class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="w-100 justify-content-between">
                                                    <img src="{{ $recentPost->getImage() }}"
                                                        alt="{{ $recentPost->title }}" class="img-fluid float-left">
                                                    <h5 class="mb-1">{{ $recentPost->title }}</h5>
                                                    <small>{{ $recentPost->created_at->format('d M, Y') }}</small>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">Advertising</h2>
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="{{ asset('upload/banner_03.jpg') }}" alt=""
                                            class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">Popular Tags</h2>
                                <div class="link-widget">
                                    <ul>
                                        @foreach ($popularTags ?? ($allTags ?? []) as $t)
                                            <li><a href="{{ route('tag.show', ['id' => $t->id]) }}">{{ $t->title }}
                                                    <span>({{ $t->posts_count ?? $t->posts->count() }})</span></a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- end link-widget -->
                            </div><!-- end widget -->
                        </div><!-- end sidebar -->
                    </div><!-- end col-lg-4 -->

                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Recent Posts</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    @foreach ($recentPosts ?? [] as $recentPost)
                                        <a href="{{ route('posts.single', ['id' => $recentPost->id]) }}"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ $recentPost->getImage() }}" alt=""
                                                    class="img-fluid float-left">
                                                <h5 class="mb-1">{{ $recentPost->title }}</h5>
                                                <small>{{ $recentPost->created_at->format('d M, Y') }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div><!-- end blog-list -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Posts</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    @foreach ($popularPosts ?? [] as $popularPost)
                                        <a href="{{ route('posts.single', ['id' => $popularPost->id]) }}"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ $popularPost->getImage() }}" alt=""
                                                    class="img-fluid float-left">
                                                <h5 class="mb-1">{{ $popularPost->title }}</h5>
                                                <span class="rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div><!-- end blog-list -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Tags</h2>
                            <div class="link-widget">
                                <ul>
                                    @foreach ($popularTags ?? ($allTags ?? []) as $t)
                                        <li><a href="{{ route('tag.show', ['id' => $t->id]) }}">{{ $t->title }}
                                                <span>({{ $t->posts_count ?? $t->posts->count() }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <br>
                        <div class="copyright">&copy; {{ date('Y') }} Markedia. Design: <a
                                href="http://html.design">HTML Design</a>.</div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop">Scroll to Top</div>
    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagSelect = document.getElementById('tag_select');
            if (tagSelect) {
                tagSelect.addEventListener('change', function() {
                    if (this.value) {
                        window.location.href = this.value;
                    }
                });
            }
        });
    </script>
</body>

</html>
