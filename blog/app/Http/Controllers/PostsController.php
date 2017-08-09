<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
      return view('posts.index');
    }

    public function show()
    {
      return view('posts.show');
    }

    public function store()
    {
      // Create a new post using the request database
      //$post = new Post;

      //$post->title = request('title');
      //$post->body = request('body');

      // Save it to the database
      //$post->save();

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
