@extends('admin.layout.app_admin')

@section('title', 'Admin Panel')

@section('content')

  <!-- Информация про количество -->
  <div class="row mt-2">
    <div class="col-md-4">
      <div class="jumbotron">
        <h4 class="text-center text-primary">
          <a href="">Записи <span class="font-weight-bold text-danger">({{ count($posts) }})</span></a>
        </h4>
      </div>
    </div>

    <div class="col-md-4">
      <div class="jumbotron">
        <h4 class="text-center text-primary">
          <a href="{{ route('users') }}">Пользователи <span class="font-weight-bold text-danger">({{ count($users) }})</span></a>
        </h4>
      </div>
    </div>
    <div class="col-md-4">
      <div class="jumbotron">
        <h4 class="text-center text-primary">
          <a href="{{ route('categories.index') }}">Категории <span class="font-weight-bold text-danger">({{ count($categories) }})</span></a>
        </h4>
      </div>
    </div>
  </div>
  </div>

  <!-- Вывод всех постов -->
  <table class="container table table-striped table-bordered text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Описание</th>
      <th scope="col d-flex justify-content-center"></th>
    </tr>
  </thead>
  <tbody>
  @foreach ($posts as $post)
  <tr>
    <th scope="row">{{ $post->post_id }}</th>
    <td>{{ $post->title }}</td>
    <td>{{ $post->descr }}</td>
    <td class="d-flex justify-content-center">
        <a class="mx-1" href="{{ route('posts.show', ['post' => $post->post_id]) }}"><button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button></a>
        <a class="mx-1" href="{{ route('posts.edit', ['post' => $post->post_id]) }}"><button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button></a>
          <form class="mx-1" action="{{ route('posts.destroy', ['post' => $post->post_id]) }}" method="post" onsubmit="if(confirm('Точно удалить пост')) { return true } else { return false }">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
          </form>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>

@endsection
