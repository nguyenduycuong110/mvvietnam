@php
    $name = !empty($post->languages) && $post->languages->count() > 0 
        ? ($post->languages->first()->pivot->name ?? $post->languages->first()->name ?? $post->name ?? '') 
        : ($post->name ?? '');
    $canonical = !empty($post->languages) && $post->languages->count() > 0 
        ? write_url($post->languages->first()->pivot->canonical ?? $post->languages->first()->canonical ?? '') 
        : write_url($post->canonical ?? '');
    $image = thumb(image($post->image), 600, 400);
@endphp

<div class="post-item">
    <a href="{{ $canonical }}" title="{{ $name }}" class="image img-cover">
        <div class="skeleton-loading"></div>
        <img class="lazy-image" data-src="{{ $image }}" alt="{{ $name }}">
    </a>
    <div class="info">
        <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
    </div>
</div>

