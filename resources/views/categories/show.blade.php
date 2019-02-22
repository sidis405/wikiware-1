@extends('layouts.app')

@section('content')


    {{-- <example></example> --}}

    <h2>Posts categorised as <u>{{ $category->name }}</u> ({{ $posts->total() }})</h2>

    @foreach($posts as $post)

        @include('posts._post', ['full' => false])
        <hr>

    @endforeach

    {{ $posts->links() }}

@stop
