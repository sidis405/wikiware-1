@extends('layouts.app')

@section('content')

<h2>Create new post</h2>

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

    @csrf

    @include('posts._form')

    <button type="submit" class="btn btn-success btn-block">Publish</button>

</form>

@stop
