@extends('layouts.app')

@section('title', 'Создать пост')

@section('content')

 @auth
  <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
    	<input class="form-control" name="title" placeholder="Название статьи" type="text" value="{{ old('title') }}" required></div>
    <div class="form-group">
    	<textarea required class="form-control" placeholder="Описание статьи" name="descr" type="text" >{{ old('descr') }}</textarea>
    </div>
    <div class="form-group">
      <p>Изображение для записи</p>
      <input class="form-control" multiple name="img" type="file" >
    </div>
    <div class="input-group">
      <select name="categoryID" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
        <option selected>Выберите категорию...</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="input-group mt-3">
      <input type="submit" value="Создать пост" class="btn btn-primary">
    </div>
  </form>
@endauth

@endsection
