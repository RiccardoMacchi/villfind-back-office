@extends('layouts.app')

@section('content')
    <div class="container mb-2">
        <h2 class="fs-4 text-primary my-4">
            Update a post
        </h2>

        @include('admin.posts.partials.input_form', [
            'action' => route('admin.posts.update', $post),
            'item_to_update' => $post,
        ])
    </div>
@endsection
