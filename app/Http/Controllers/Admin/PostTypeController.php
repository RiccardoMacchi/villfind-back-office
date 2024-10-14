<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\PostType;
use App\Http\Requests\Admin\PostTypeRequest;
use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = PostType::paginate(10);

        return view('admin.post-types.index', compact('types'));
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
    public function store(PostTypeRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['name'], PostType::class);

        $new_post_type = PostType::create($data);

        return redirect()->route('admin.post-types.index', $new_post_type);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostType $post_type)
    {
        if (!isset($post_type)) {
            abort(404);
        }

        $post_type->delete();

        return redirect()->route('admin.post-types.index');
    }
}
