@isset($breadcrumbs)
    <div class="alert alert-info">
        @foreach ($breadcrumbs as $b)
            @if ($loop->last)
                <span>{{ $b["name"] }}</span>
            @else
                <span><a href="{{ $b["url"] }}">{{ $b["name"] }}</a> / </span>
            @endif
        @endforeach
    </div>
@endisset
