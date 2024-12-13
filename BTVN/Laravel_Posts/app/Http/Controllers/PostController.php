<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Request $request, string $id)
    {
        $post = Post::find($id);
        $currentPage = $request->query('page', 1);

        return view('posts.edit', compact('post', 'currentPage'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::find($id);
        $post->update($request->all());
        $currentPage = $request->query('page', 1);

        return redirect()->route('posts.index', ['page' => $currentPage])
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Request $request, string $id)
    {
        $post = Post::find($id);
        $post->delete();
        $currentPage = $request->query('page', 1);

        return redirect()->route('posts.index', ['page' => $currentPage])
            ->with('success', 'Post deleted successfully');
    }
}
