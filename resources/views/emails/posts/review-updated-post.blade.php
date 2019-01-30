@component('mail::message')
# Hello {{ $recipient->name }}

The post <strong>"{{ $post->title }}"</strong> was modified by {{ $sender->name }}.

@component('mail::button', ['url' => route('posts.show', $post)])
View Updated Version
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
