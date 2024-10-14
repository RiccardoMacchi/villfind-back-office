<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Tag;
use Illuminate\Foundation\Vite;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getAllPosts()
    {
        $posts = Post::with('postType', 'tags')->get();
        $succes = boolval($posts);

        if ($succes) {
            $this->setPostsImage($posts);
        }

        return response()->json(compact('succes', 'posts'));
    }

    public function getPostsByTagSlug($slug)
    {
        $tag = Tag::where('slug', $slug)->with(['posts.postType', 'posts.tags'])->first();
        $succes = boolval($tag && $tag->posts->isNotEmpty());

        $posts = collect();
        if ($succes) {
            $posts = $tag->posts;
            $this->setPostsImage($posts);
        }

        return response()->json(compact('succes', 'posts'));
    }

    public function getPostsByTypeSlug($slug)
    {
        $type = PostType::where('slug', $slug)->with(['posts.postType', 'posts.tags'])->first();
        $succes = boolval($type && $type->posts->isNotEmpty());

        $posts = collect();
        if ($succes) {
            $posts = $type->posts;
            $this->setPostsImage($posts);
        }

        return response()->json(compact('succes', 'posts'));
    }

    public function getAllTags()
    {
        $tags = Tag::all();
        $succes = boolval($tags);

        return response()->json(compact('succes', 'tags'));
    }

    public function getAllTypes()
    {
        $types = PostType::all();
        $succes = boolval($types);

        return response()->json(compact('succes', 'types'));
    }

    public function getPostBySlug($slug)
    {
        $post = Post::where('slug', $slug)->with('postType', 'tags')->first();
        $succes = boolval($post);


        if ($succes) {
            $this->setPostImage($post);
        }

        return response()->json(compact('succes', 'post'));
    }



    private function setPostImage(Post $post)
    {
        if ($post->img_path) {
            $post->img_path = asset('storage/' . $post->img_path);
        } else {
            $post->img_path = '/images/image-placeholder.jpg';
            $post->img_original_name = 'no-image';
        }
    }

    private function setPostsImage($posts)
    {
        foreach ($posts as $post) {
            $this->setPostImage($post);
        }
    }
}
