<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-inverse-primary">
            @foreach(Request::segments() as $segment)
            @if ($loop->last ) 
            <li class="breadcrumb-item">
                <a href="{{ Request::url() }}">
                @if($loop->iteration !== 2)
                    {{ $segment }}
                @endif
                </a>
                @else
                <li class="breadcrumb-item active" aria-current="page">{{ $segment }}</li>
                @endif
            </li>
            @endforeach
        </ol>
    </nav>
</div>