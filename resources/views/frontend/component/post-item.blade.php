@php
    $name = !empty($post->languages) && $post->languages->count() > 0 
        ? ($post->languages->first()->pivot->name ?? $post->languages->first()->name ?? $post->name ?? '') 
        : ($post->name ?? '');
    $canonical = !empty($post->languages) && $post->languages->count() > 0 
        ? write_url($post->languages->first()->pivot->canonical ?? $post->languages->first()->canonical ?? '') 
        : write_url($post->canonical ?? '');
    $description = !empty($post->languages) && $post->languages->count() > 0 
        ? ($post->languages->first()->pivot->description ?? $post->languages->first()->description ?? $post->description ?? '') 
        : ($post->description ?? '');
    $image = thumb(image($post->image), 600, 400);
    $created_at = $post->created_at ?? '';
    $description_short = !empty($description) ? cutnchar(strip_tags($description), 120) : '';
@endphp

<div class="post-item" style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column;">
    <a href="{{ $canonical }}" title="{{ $name }}" class="image img-cover img-zoomin" style="display: block; position: relative; overflow: hidden; padding-top: 60%;">
        <div class="skeleton-loading"></div>
        <img class="lazy-image" data-src="{{ $image }}" alt="{{ $name }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
    </a>
    <div class="info" style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
        @if($created_at)
        <div class="post-meta" style="margin-bottom: 12px;">
            <div class="time" style="display: flex; align-items: center; gap: 6px; color: #666; font-size: 13px;">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.80657 0.55838C10.9552 0.55838 13.0159 1.41193 14.5352 2.93125C16.0545 4.45058 16.9081 6.51122 16.9081 8.65987C16.9081 10.8085 16.0545 12.8692 14.5352 14.3885C13.0159 15.9078 10.9552 16.7614 8.80657 16.7614C6.65792 16.7614 4.59727 15.9078 3.07795 14.3885C1.55863 12.8692 0.705078 10.8085 0.705078 8.65987C0.705078 6.51122 1.55863 4.45058 3.07795 2.93125C4.59727 1.41193 6.65792 0.55838 8.80657 0.55838ZM8.80657 1.41117C6.88409 1.41117 5.04036 2.17487 3.68096 3.53427C2.32157 4.89366 1.55787 6.7374 1.55787 8.65987C1.55787 10.5823 2.32157 12.4261 3.68096 13.7855C5.04036 15.1449 6.88409 15.9086 8.80657 15.9086C9.75848 15.9086 10.7011 15.7211 11.5805 15.3568C12.46 14.9925 13.2591 14.4586 13.9322 13.7855C14.6053 13.1124 15.1392 12.3133 15.5035 11.4338C15.8678 10.5544 16.0553 9.61178 16.0553 8.65987C16.0553 6.7374 15.2916 4.89366 13.9322 3.53427C12.5728 2.17487 10.729 1.41117 8.80657 1.41117ZM8.38018 3.96953H9.23296V8.59165L13.2411 10.9027L12.8147 11.6446L8.38018 9.08627V3.96953Z" fill="#FFA629"/>
                </svg>
                <span>{{ \Carbon\Carbon::parse($created_at)->format('d/m/Y') }}</span>
            </div>
        </div>
        @endif
        <h3 class="title" style="margin: 0 0 12px 0; line-height: 1.4;">
            <a href="{{ $canonical }}" title="{{ $name }}" style="color: #333; text-decoration: none; font-size: 16px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s ease;">{{ $name }}</a>
        </h3>
        @if($description_short)
        <div class="description" style="color: #666; font-size: 14px; line-height: 1.6; margin-top: auto; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $description_short }}
        </div>
        @endif
    </div>
</div>

<style>
.post-item:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.15) !important;
    transform: translateY(-4px);
}
.post-item:hover .image img {
    transform: scale(1.05);
}
.post-item:hover .title a {
    color: #FFA629;
}
</style>

