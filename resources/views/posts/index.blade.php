@extends('layouts.app')

@section('content')

    <h2>Latests posts ({{ $posts->total() }})</h2>

    @foreach($posts as $post)

        @include('posts._post', ['full' => false])
        <hr>

    @endforeach

    {{ $posts->links() }}

@stop
