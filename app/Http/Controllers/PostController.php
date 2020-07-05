<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{

    public function __construct () {
      $this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::
        orderby('posts.created_at', 'desc')->paginate(4);
        return view('posts.index', compact('posts'));
    }

    // Search

    public function SearchPost (Request $request) {
      if($request->search) {
        $posts = Post::
        where('title', 'like', '%'. $request->search .'%')->
        orwhere('descr', 'like', '%'. $request->search .'%')->
        get();
        return view('search', [
          'posts' => $posts,
          'search' => $request->search
        ])->with('success', 'Пост успешно отредактирован');
      }
    }

    // Search

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->descr = $request->descr;
        $post->author_id = \Auth::user()->id;
        $post->category_id = $request->categoryID;
        if ($request->file('img')) {
        $path = $request->file('img')->store('/');

        $request->file('img')->move('uploads/img', $path);

        $post->img = $path;  };
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Пост успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post) {
          return redirect()->route('posts.index')->with('success', 'Пост не найден');
        }
        return view('posts.show', compact('post'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $post = Post::find($id);
          if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('posts.index')->witherrors( 'Вы не можете редактировать данный пост. Отказано в доступе');
          }
          $categories = Category::all();
          return view('posts.edit', compact('post', 'categories'));
        


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
      $post = Post::find($id);
      if ($post->author_id != \Auth::user()->id) {
        return redirect()->route('posts.index')->witherrors( 'Вы не можете редактировать данный пост. Отказано в доступе');;
      }
      else {
      $post->title = $request->title;
      $post->descr = $request->descr;
      if ($request->file('img')) {
        Storage::delete("/public/uploads/$post->img");
        $path = $request->file('img')->store('/');
        $request->file('img')->move('uploads/img', $path);
        $post->img = $path;
      };
      $post->updated_at = date('Y-m-d H:i:s');
      $post->category_id = $request->categoryID;
      $post->update();
      $post = $post->post_id;
      return redirect()->route('posts.show', compact('post'))->with('success', 'Пост успешно отредактирован');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (\Auth::user()->status == 'admin' || $post->author_id == \Auth::user()->id) {
        Storage::delete("/uploads/img/$post->img");
        $post->delete();
          return redirect()->route('posts.index')->with('success', 'Пост успешно удален');
        }
        if ($post->author_id != \Auth::user()->id) {
          return redirect()->route('posts.index')->witherrors( 'Вы не можете удалить данный пост. Отказано в доступе');
        }
    }
}
