@extends('admin.layout.app_admin')

@section('title', 'Категории - Админ панель')

@section('content')

<h1 class="text-center mb-2">Категории</h1>
  <!-- Вывод всех постов -->
  <table class="table table-bordered text-center table-info">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Количество записей</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach ($categories as $category)
  <tr>
    <th scope="row">{{ $category->id }}</th>
    <td>{{ $category->name }}</td>
    <td>{{  count(App\Category::find($category->id)->posts) }}</td>

    <td class="d-flex justify-content-center">
        <a class="mx-1" href="{{ route('categories.show', ['category' => $category->id]) }}"><button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button></a>
        <a class="mx-1" href="{{ route('categories.edit', ['category' => $category->id]) }}"><button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button></a>
          <form class="mx-1" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post" onsubmit="if(confirm('Точно удалить категорию')) { return true } else { return false }">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
          </form>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
<a class="text-right d-block" href="{{ route('categories.create') }}"><button class="btn btn-warning ">Добавить категорию</button></a>

@endsection
