    <div class="content-wrapper">
        <!DOCTYPE html>
        <html lang="en">

        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Site Metas -->
        <title>Markedia - Marketing Blog Template</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Site Icons -->
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

        <!-- Design fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">

        <!-- FontAwesome Icons core CSS -->
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="style.css" rel="stylesheet">

        <!-- Animate styles for this template -->
        <link href="css/animate.css" rel="stylesheet">

        <!-- Responsive styles for this template -->
        <link href="css/responsive.css" rel="stylesheet">

        <!-- Colors for this template -->
        <link href="css/colors.css" rel="stylesheet">

        <!-- Version Marketing CSS for this template -->
        <link href="css/version/marketing.css" rel="stylesheet">

        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

        </head>

        <body>

            <div id="wrapper">
                <header class="market-header header">
                    <div class="container-fluid">
                        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <a class="navbar-brand" href="marketing-index.html"><img
                                    src="images/version/market-logo.png" alt=""></a>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="marketing-index.html">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="marketing-category.html">Marketing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="marketing-category.html">Make Money</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="marketing-blog.html">Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="marketing-contact.html">Contact Us</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="text" placeholder="How may I help?">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
                    </div><!-- end container-fluid -->
                </header><!-- end market-header -->

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
                                        <input type="text" name="email" placeholder="Add your email here.."
                                            required class="form-control" />
                                        <input type="submit" value="Subscribe" class="btn btn-default btn-block" />
                                    </form>
                                </div><!-- end newsletter -->
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section lb">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                <div class="page-wrapper">
                                    <div class="blog-custom-build">
                                        @foreach ($post as $p)
                                            <div class="blog-box wow fadeIn">
                                                <div class="post-media">
                                                    <a href="{{ route('posts.single', ['id' => $p->id]) }}"
                                                        title="">
                                                        <img src="{{ $p->getImage() }}" alt="{{ $p->title }}"
                                                            class="img-fluid">
                                                        <div class="hovereffect">
                                                            <span></span>
                                                        </div>
                                                        <!-- end hover -->
                                                    </a>
                                                </div>
                                                <!-- end media -->
                                                <div class="blog-meta big-meta text-center">
                                                    <div class="post-sharing">
                                                        <ul class="list-inline">
                                                            <li><a href="#" class="fb-button btn btn-primary"><i
                                                                        class="fa fa-facebook"></i> <span
                                                                        class="down-mobile">Share on
                                                                        Facebook</span></a>
                                                            </li>
                                                            <li><a href="#" class="tw-button btn btn-primary"><i
                                                                        class="fa fa-twitter"></i> <span
                                                                        class="down-mobile">Tweet on Twitter</span></a>
                                                            </li>
                                                            <li><a href="#" class="gp-button btn btn-primary"><i
                                                                        class="fa fa-google-plus"></i></a></li>
                                                        </ul>
                                                    </div><!-- end post-sharing -->
                                                    <h4><a href="{{ route('posts.single', ['id' => $p->id]) }}"
                                                            title="">{{ $p->title }}</a></h4>
                                                    <p>{{ Str::limit(strip_tags($p->content), 200) }}</p>
                                                    <small><a href="#"
                                                            title="">{{ $p->category->title }}</a></small>
                                                    <small><a href="{{ route('posts.single', ['id' => $p->id]) }}"
                                                            title="">{{ $p->created_at->format('d F, Y') }}</a></small>
                                                    <small><a href="#" title="">by Admin</a></small>
                                                    <small><a href="#" title=""><i class="fa fa-eye"></i>
                                                            {{ $p->views }}</a></small>
                                                </div><!-- end meta -->
                                            </div><!-- end blog-box -->

                                            <hr class="invis">
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="invis">

                                <div class="row">
                                    <div class="col-md-12">
                                        <nav aria-label="Page navigation">
                                            {{ $post->links('pagination::bootstrap-4') }}
                                        </nav>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end col -->

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

                                    <div id="" class="widget">
                                        <h2 class="widget-title">Advertising</h2>
                                        <div class="banner-spot clearfix">
                                            <div class="banner-img">
                                                <img src="{{ asset('upload/banner_03.jpg') }}" alt=""
                                                    class="img-fluid">
                                            </div><!-- end banner-img -->
                                        </div><!-- end banner -->
                                    </div><!-- end widget -->

                                    <div class="widget">
                                        <h2 class="widget-title">Popular Categories</h2>
                                        <div class="link-widget">
                                            <ul>
                                                @foreach ($categories ?? [] as $category)
                                                    <li><a href="#">{{ $category->title }}
                                                            <span>({{ $category->posts_count ?? 0 }})</span></a></li>
                                                @endforeach
                                            </ul>
                                        </div><!-- end link-widget -->
                                    </div><!-- end widget -->
                                </div><!-- end sidebar -->
                            </div><!-- end col -->
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
                                    <h2 class="widget-title">Popular Categories</h2>
                                    <div class="link-widget">
                                        <ul>
                                            @foreach ($categories ?? [] as $category)
                                                <li><a href="#">{{ $category->title }}
                                                        <span>({{ $category->posts_count ?? 0 }})</span></a></li>
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
            <script src="js/jquery.min.js"></script>
            <script src="js/tether.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/animate.js"></script>
            <script src="js/custom.js"></script>

        </body>

        </html>
    </div>
