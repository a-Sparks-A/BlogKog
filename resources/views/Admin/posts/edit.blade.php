@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактирование статьи</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Редактирование статьи</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Редактирование статьи "{{ $post->title }}"</h3>
                            </div>
                            <!-- /.card-header -->

                            <form role="form" method="post" action="{{ route('posts.update', ['post' => $post->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Название</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="title"
                                            value="{{ $post->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Цитата</label>
                                        <textarea name="description" id="description" rows="3" class="form-control" placeholder="Цитата...">{{ $post->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Контент</label>
                                        <textarea name="content" id="content" rows="3" class="form-control" placeholder="Контент...">{{ $post->content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Категория</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach ($categories as $k => $v)
                                                <option value="{{ $k }}"
                                                    @if ($k == $post->category_id) selected @endif>{{ $v }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Теги</label>
                                        <select name="tags[]" id="tags" class="select2" multiple="multiple"
                                            data-placeholder="Выбор тегов" style="width: 100%;">
                                            @foreach ($tags as $k => $v)
                                                <option value="{{ $k }}"
                                                    @if (in_array($k, $post->tags->pluck('id')->toArray())) selected @endif>{{ $v }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnail">Изображение</label>
                                        <div>
                                            <img src="{{ $post->thumbnail }}" alt="" class="img-thumbnail mb-2"
                                                width="200">
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="thumbnail" id="thumbnail"
                                                    class="custom-file-input">
                                                <label class="custom-file-label" for="thumbnail">Выбрать файл</label>
                                            </div>
                                        </div>
                                        @if ($post->getImage())
                                            <img src="{{ $post->getImage() }}" alt="Текущее изображение"
                                                class="img-thumbnail mt-2" width="200">
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
