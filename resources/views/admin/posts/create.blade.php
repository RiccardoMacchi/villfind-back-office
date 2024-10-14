@extends('layouts.app')

@section('content')
    <div class="container mb-2">
        <h2 class="fs-4 text-primary my-4">
            Create a new post
        </h2>

        @include('admin.posts.partials.input_form', [
            'action' => route('admin.posts.store'),
            'item_to_update' => null,
        ])
    </div>
@endsection
