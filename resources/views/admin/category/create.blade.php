@extends('admin.layout.app_admin')

@section('title', 'Добавить категорию')

@section('content')

  <form method="post" action="{{ route('categories.store') }}" class="my-4">
    @csrf
    <div class="form-group">
    	<input class="form-control" name="name" placeholder="Название категорию" type="text" value="{{ old('title') }}" required>
    </div>
    <div class="input-group mt-3">
      <input type="submit" value="Создать категорию" class="btn btn-success">
    </div>
  </form>

@endsection
