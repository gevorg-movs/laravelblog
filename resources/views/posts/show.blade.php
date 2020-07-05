@extends('layouts.app')

@section('title', $post->title)

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-center"><h1>{{ $post->title }}</h1></div>
        <div class="card-body">
          <div class="card-image"><img class="card-img" src="/uploads/img/{{ $post->img ?? 'img/default.png' }}" alt=""></div>
          <div class="card-descr mt-5 mb-5">{{ $post->descr }}</div>

          <div class="row">
            <div class="col-md"><span class="font-weight-bold">Добавлен:</span> {{ $post->created_at->diffforhumans() }}</div>
          </div>

          <div class="row">
            <div class="col-md"><span class="font-weight-bold">Обновлен:</span> {{ $post->updated_at->diffforhumans() }}</div>
          </div>

          <div class="row">
            <div class="col-md"><span class="font-weight-bold">Категория:</span> {{ $post->category->name }}</div>
          </div>

          <div class="row">
            <div class="col-md"><span class="font-weight-bold">Автор: </span> {{  $post->user->name . ', ' .     $post->user->email  }}</div>
          </div>         

          <div class="d-flex  my-3">
            <div class="mr-2"><a class="btn btn-primary" href="{{ route('home') }}">На главную</a></div>
            <div class="mr-2"><a class="btn btn-warning" href="{{ route('posts.edit', ['post' => $post->post_id]) }}">Редактировать</a></div>           
                <form action="{{ route('posts.destroy', ['post' => $post->post_id]) }}" method="post" onsubmit="if(confirm('Точно удалить пост')) { return true } else { return false }">
                  @csrf
                  @method('DELETE')
                  <input class="btn btn-danger" type="submit" name="" value="Удалить">
                </form>        
          </div>
        </div>      
    </div>
    </div>
  </div>

@endsection
