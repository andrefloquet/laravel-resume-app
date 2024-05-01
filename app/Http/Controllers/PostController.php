<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::with('user')->latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title'], '-');

        $post = Post::create($validated);

        return response()->json(['success' => 'Post created successfully', 'post' => $post], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post->load('user');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //TODO: the validation is not working somehow. Try to fix it up.
        $postData = $request->all();

        $postData['slug'] = Str::slug($request['title'], '-');

        $post->update($postData);

        return response()->json(['success' => 'Post successfully updated', 'post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
