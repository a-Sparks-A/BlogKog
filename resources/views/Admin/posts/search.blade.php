@extends('admin.layouts.app')

@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Поиск: {{ $s }}</h2>
                </div><!--end col -->
                {{-- <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Search</li>
                    </ol>
                </div><!--end col --> --}}
            </div><!--end row -->
        </div><!--end container -->
    </div><!--end page-title -->
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="blog-box wow fadeIn">
                        @if ($post->thumbnail)
                            <div class="post-media">
                                <a href="{{ route('posts.single', $post->id) }}" title="{{ $post->title }}">
                                    <img src="{{ $post->getImage() }}" alt="{{ $post->title }}" class="img-fluid">
                                    <div class="hovereffect"></div>
                                </a>
                            </div>
                        @endif
                        <div class="blog-meta big-meta text-center">
                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i>
                                            <span class="down-mobile">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i>
                                            <span class="down-mobile">Tweet on Twitter</span></a></li>
                                    <li><a href="#" class="gp-button btn btn-primary"><i
                                                class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                            <h4><a href="{{ route('posts.single', $post->id) }}"
                                    title="{{ $post->title }}">{{ $post->title }}</a></h4>
                            <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                            @if ($post->category)
                                <small><a href="{{ route('category.show', ['id' => $post->category->id]) }}"
                                        title="{{ $post->category->title }}">{{ $post->category->title }}</a></small>
                            @endif
                            <small><a href="{{ route('posts.single', ['id' => $post->id]) }}"
                                    title="">{{ $post->created_at->format('d M, Y') }}</a></small>
                            <small><a href="#" title="">by Admin</a></small>
                            <small><a href="#" title=""><i class="fa fa-eye"></i>
                                    {{ $post->views }}</a></small>
                        </div>
                    </div>
                    <hr class="invis">
                @endforeach
            @else
                <p>По вашему запросу ничего не найдено!</p>
            @endif
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page Navigation">
                {{ $posts->appends(['s' => request()->s])->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
