<div class="page-header">
    @php
         $segments = ''; 
    @endphp 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-inverse-primary">
            @foreach(Request::segments() as $segment)
                @php
                $segments .= '/'.$segment;
                @endphp 
                @if (!$loop->last ) 
            <li class="breadcrumb-item">
                <a href="{{ $segments }}">{{$segment}}</a>
                @else
                <li class="breadcrumb-item active" aria-current="page">{{$segment}}</li>
                @endif
            </li>
            @endforeach



        </ol>
    </nav>
</div>