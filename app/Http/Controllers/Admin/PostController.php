<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\PostType;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = PostType::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('types', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['title'], Post::class);
        $data['reading_time'] = Helper::getReadingTime($data['body']);

        if ($request->hasFile('img_path')) {
            $data['img_path'] = Storage::put('uploads', $data['img_path']);
            $data['img_original_name'] = $request->file('img_path')->getClientOriginalName();
        }

        $new_post = Post::create($data);

        if (array_key_exists('tags', $data)) {
            $new_post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (!isset($post)) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!isset($post)) {
            abort(404);
        }

        $types = PostType::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'types', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        if (!isset($post)) {
            abort(404);
        }

        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['title'], Post::class);
        $data['reading_time'] = Helper::getReadingTime($data['body']);

        if ($request->hasFile('img_path') || $request->input('img_delete')) {
            if ($post->img_path) {
                Storage::delete($post->img_path);
            }

            if ($request->hasFile('img_path')) {
                $data['img_path'] = Storage::put('uploads', $data['img_path']);
                $data['img_original_name'] = $request->file('img_path')->getClientOriginalName();
            } else {
                $data['img_path'] = null;
                $data['img_original_name'] = null;
            }
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($request->input('tags'));
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!isset($post)) {
            abort(404);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
