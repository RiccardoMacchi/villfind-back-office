@extends('layouts.app')

@section('content')
    <div class="container mb-2">
        <h2 class="fs-4 text-primary my-4">
            Posts
        </h2>

        <div class="card mb-3">
            <div class="card-header">
                {{ $posts->links() }}
            </div>

            <ul class="list-group list-group-flush d-flex">
                <li class="list-group-item overflow-auto p-0">
                    <table class="table table-striped table-hover align-middle mb-0 text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="text-primary text-start col-1">#</th>

                                <th scope="col" class="text-primary col-4">Title</th>

                                <th scope="col" class="text-primary col-2">Type</th>

                                <th scope="col" class="text-primary col-1">Tags</th>

                                <th scope="col" class="text-primary col-1">Status</th>

                                <th scope="col" class="text-primary col-3">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row" class="col-1 text-start">{{ $post['id'] }}</th>

                                    <td class="col-4 text-start">{{ $post['title'] }}</td>

                                    <td class="col-2">{{ isset($post->postType) ? $post->postType->name : 'None' }}</td>

                                    <td class="col-1">
                                        @foreach ($post->tags as $tag)
                                            <span class="badge text-bg-primary">{!! $tag->name !!}</span>
                                        @endforeach
                                    </td>

                                    <td class="col-1">{{ $post['is_archived'] ? 'Archived' : 'Active' }}</td>

                                    <td class="col-3">
                                        <menu class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </menu>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </li>

                <li class="list-group-item text-center">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
