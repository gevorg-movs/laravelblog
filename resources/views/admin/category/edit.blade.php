@extends('admin.layout.app_admin')

@section('title', 'Редактировать категорию')

@section('content')

<h3 class="my-4">Редактировать категорию <b>{{ $category['0']->name }}</b></h3>
<form method="post" action="{{ route('categories.update', ['category' => $category['0']->id]) }}" class="my-4">
  @csrf
  @method('PATCH')
  <div class="form-group">
    <input class="form-control" name="name" placeholder="Название категорию" type="text" value="{{ old('name') ?? $category['0']->name ?? '' }}" required>
  </div>
  <div class="input-group mt-3">
    <input type="submit" value="Редактировать категорию" class="btn btn-success">
  </div>
</form>

@endsection
