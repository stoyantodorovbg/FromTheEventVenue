<div class="card mb-3">
    <div class="card-header">
        <a class="text-uppercase" href="{{ route('news.show', $item) }}">
            {{ $item->title }}
        </a>
    </div>
    <div class="card-body pb-0">
        <p>
            {{ Str::limit($item->body, 200, '...') }}
        </p>
        <p class="text-right font-italic" >
            {{ $item->created_at->diffForHumans() }}
        </p>
    </div>
</div>
