@extends('layouts.app')

@section('title')Найденные посты - {{ count($posts) }}@endsection

@section('content')


@if (count($posts) > 0)
    <div class="alert alert-success mb-2 mt-2" role="alert" id="alert-success">
      По запросу <b>{{ $search }}</b> найдено <b>{{ count($posts) }}</b> результатов
    </div>
@else
    <div class="alert alert-success mb-2 mt-2" role="alert" id="alert-success">
    По запросу <b>{{ $search }}</b> ничего не найдено
    </div>
@endif

<div class="row ">
    @foreach ($posts as $post)
    <div class="col-md-6 mt-4 mb-4">
      <div class="card">
        <div class="card-header"><h5 class="font-weight-bold text-center">{{ $post->title }}</h5></div>
        <div class="card-body">
          <div class="card-image">
            <div style="background: url(/uploads/img/{{ $post->img ?? 'default.png' }}) no-repeat; 
              width: 100%; 
              height: 300px;
              background-position: top left;
              background-size: cover;
              ">
            </div>            
          </div>
          <div class="card-descr mt-3"><b>Описание:</b> {{ mb_substr( $post->descr, 0, 120) . '...' }}</div>
          <div class="mt-2 d-flex justify-content-between align-items-center">
            <div class="text-center"><b>Автор статьи:</b> {{ $post->user->name }}</div>           
          </div>
          <a href="{{ route('posts.show', ['post' => $post->post_id] ) }}" class="d-block btn btn-warning my-4">Посмотреть пост</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection


