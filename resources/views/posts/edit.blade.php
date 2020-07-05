@extends('layouts.app')

@section('title', 'Редактировать пост' . ' ' . $post->title)

@section('content')
  <form method="post" action="{{ route('posts.update', ['post' => $post->post_id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <h3>Редактировать пост</h3>
    <div class="form-group"><input class="form-control" name="title" type="text" value="{{ old('title') ?? $post->title ?? '' }}" required></div>
    <div class="form-group"><textarea required class="form-control" name="descr" type="text">{{ $post->descr ?? '' }}</textarea></div>
    <div class="form-group">
      <input class="form-control" multiple name="img" type="file" value="{{ $post->img }}">
    </div>
    @if ($post->img)
    <div class="row">
      <div class="col-md-2 mr-auto mb-4" >
        <img style="width: 400px" src="/uploads/img/{{ $post->img ?? '' }}" alt="">
      </div>
    </div>
    @endif  
    <div class="input-group">
      <select name="categoryID" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" >
        <option selected value="{{ $post->category->id }}">{{ $post->category->name }} </option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="input-group mt-3">  <input type="submit" value="Редактировать пост" class="btn btn-primary" name="" id=""></div>
  </form>

@endsection
