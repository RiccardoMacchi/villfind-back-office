@extends('layouts.app')

@section('content')
    <div class="container mb-3 ">
        <h1 class="text-primary my-4">
            Messages
        </h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="col-md-8 col-12">
            <x-admin.table :items="$messages" :columns="$columns" :isViewable="true" class="custom-table" />
        </div>
    </div>
@endsection
