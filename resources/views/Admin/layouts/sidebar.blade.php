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
                                <img src="{{ $recentPost->getImage() }}" alt="{{ $recentPost->title }}"
                                    class="img-fluid float-left">
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
                    <img src="{{ asset('upload/banner_03.jpg') }}" alt="" class="img-fluid">
                </div><!-- end banner-img -->
            </div><!-- end banner -->
        </div><!-- end widget -->

        <div class="widget">
            <h2 class="widget-title">Popular Categories</h2>
            <div class="link-widget">
                <ul>
                    @foreach ($popularCategoriesSidebar ?? ($allCategories ?? []) as $categoryItem)
                        <li>
                            <a href="{{ route('category.show', ['id' => $categoryItem->id]) }}">{{ $categoryItem->title }}
                                <span>({{ $categoryItem->posts_count ?? $categoryItem->posts->count() }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div><!-- end link-widget -->
        </div><!-- end widget -->
    </div><!-- end sidebar -->
</div><!-- end col -->
