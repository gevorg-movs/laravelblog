@extends('admin.layout.app_admin')

@section('title', 'Все пользователи')

@section('content')

<h1 class="text-center mb-2">Пользователи</h1>
  <!-- Вывод всех постов -->
  <table class="table table-striped table-bordered text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Email</th>
      <th scope="col">Статус</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($users as $user)
  <tr>
    <th scope="row">{{ $user->id }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->status }}</td>
  </tr>
  @endforeach
  </tbody>
</table>

@endsection
