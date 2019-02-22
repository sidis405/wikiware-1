<div class="card">
    <img src="{{ $post->cover }}" />
    <div class="card-header">
        <a href="{{ route('posts.show', $post) }}"><h4>{{ $post->title }}</h4></a>
        <span>by <strong>{{ $post->user->name }}</strong></span>
        <span>on <strong>{{ $post->created_at->format('d/m/Y H:i') }}</strong></span>
        @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}">[Edit]</a>
        @endcan

    </div>
    <div class="card-body">
        {!! $post->preview !!}

        @if($full)
            {!! nl2br($post->body) !!}
        @endif
    </div>
    <div class="card-footer">
        <span>on <strong>{{ $post->category->name }}</strong></span>
        <span>tags: {{ $post->tags->pluck('name')->implode(', ') }}</span>
    </div>

    @can('attach', $post)
        <div class="card-footer">
            <a href="{{ route('posts.attachment', $post) }}">Attachment</a>
        </div>
    @endcan
</div>
