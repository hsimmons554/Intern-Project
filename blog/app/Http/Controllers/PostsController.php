<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
      $posts = Post::latest()->get();
      return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {

      return view('posts.show', compact('post'));
    }

    public function store()
    {
      // Create a new post using the request database
      //$post = new Post;

      //$post->title = request('title');
      //$post->body = request('body');

      // Save it to the database
      //$post->save();

      // Built in validation in Laravel
      $this->validate(request(), [
          'title' => 'required',
          //'title' => 'required|min:10|' etc etc
          'body' => 'required'
      ]);

      Post::create([
        'title' => request('title'),
        'body' => request('body')
      ]);

      // And then redirect to the homepage
      return redirect('/');
    }

    public function create()
    {
      return view('posts.create');
    }
}
