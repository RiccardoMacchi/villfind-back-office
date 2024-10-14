@extends('layouts.app')

@section('content')
    <div class="container mb-2">
        <h2 class="fs-4 text-primary my-4">
            Post details
        </h2>

        <div class="card mb-3">
            <div class="card-header">
                <h3 class="text-center">
                    {{ $post['id'] }}
                </h3>
            </div>

            <ul class="list-group list-group-flush d-flex">
                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Title:
                    </strong>

                    <span class="fs-4">
                        {{ $post['title'] }}
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Slug:
                    </strong>

                    <span class="fs-4">
                        {{ $post['slug'] }}
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Type:
                    </strong>

                    <span class="fs-4">
                        {{ isset($post->postType) ? $post->postType->name : 'None' }}
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Tags:
                    </strong>

                    <span class="fs-4">
                        @if ($post->tags->toArray() !== [])
                            @foreach ($post->tags as $tag)
                                <span class="badge text-bg-primary">{!! $tag->name !!}</span>
                            @endforeach
                        @else
                            None
                        @endif
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Body:
                    </strong>

                    <span class="fs-4">
                        {{ $post['body'] }}
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Reading Time:
                    </strong>

                    <span class="fs-4">
                        {{ $post['reading_time'] . ' ' . ($post['reading_time'] == 1 ? 'minute' : 'minutes') }}
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Archived:
                    </strong>

                    <span class="fs-4">
                        {{ $post['is_archived'] ? 'Yes' : 'No' }}
                    </span>
                </li>

                <li class="list-group-item">
                    <strong class="d-block ms-3 text-primary">
                        Image:
                    </strong>

                    @if ($post->img_path)
                        <div>
                            <img class="w-100" src="{!! asset('storage/' . $post->img_path) !!}" alt="{{ $post->title }}">
                        </div>
                    @else
                        <span class="fs-4">
                            None
                        </span>
                    @endif
                </li>

                <li class="list-group-item">
                    <menu class="d-flex justify-content-center gap-1">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                            <i class="fa-solid fa-eye-slash"></i>
                        </a>

                        <a href="{{ route('admin.posts.edit', $post) }}" type="button"
                           class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                            @csrf

                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </menu>
                </li>
            </ul>
        </div>
    </div>
@endsection
