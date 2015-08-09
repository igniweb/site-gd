<div class="ui items">
    <div class="item">
        @if (!empty($image))
            <div class="ui image">
                <img src="{{ $image }}" width="32" height="32">
            </div>
        @endif
        <div class="middle aligned content">
            @if (!empty($link))
                <a href="{{ $link }}" class="header">{{ $header }}</a>
            @else
                <div class="header">{{ $header }}</div>
            @endif
            @if (!empty($description))
                <div class="description">
                    {!! $description !!}
                </div>
            @endif
            @if (!empty($extra))
                <div class="extra">
                    {!! $extra !!}
                </div>
            @endif
        </div>
    </div>
</div>
