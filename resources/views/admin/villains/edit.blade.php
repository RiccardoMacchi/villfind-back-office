@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">Edit Villain Profile</h1>

        @include('admin.villains.partials.create_update_form', [
            'action' => route('admin.villains.update', $villain),
            'villain' => $villain,
        ])
    </div>
@endsection
