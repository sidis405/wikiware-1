@extends('layouts.app')

@section('content')

<h2>Edit post</h2>

<form method="POST" action="{{ route('posts.update', $post) }}">

    @csrf
    @method('PATCH')

    @include('posts._form')

    <button type="submit" class="btn btn-warning btn-block">Update</button>

</form>

@can('delete', $post)

<hr>

    <form method="POST" action="{{ route('posts.destroy', $post) }}">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

@endcan

@stop
