@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="col-md-8 offset-md-4">
            <button class="btn btn-primary"><a href={{ 'login' }}>became one of the bad guys</a></button>
        </div>

    </form>
@endsection
