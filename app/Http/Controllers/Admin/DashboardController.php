<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;

class DashboardController extends Controller
{
    public function dashboard () {
      $posts = Post::all();
      $users = User::all();
      $categories = Category::all();
      return view('admin.dashboard', compact('posts', 'users', 'categories'));
    }

    public function getUsers () {
      $users = User::all();
      return view('admin.users', compact('users'));
    }
}
