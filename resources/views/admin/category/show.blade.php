@extends('admin.layout.app_admin')

@section('title', $categories['0']->name)

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-center"><h1>Все посты категории: {{ $categories['0']->name }}</h1></div>
        <div class="card-body">
          <table class="container table table-secondary table-striped table-bordered text-center">
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
        </div>
    </div>
    </div>
  </div>

@endsection
