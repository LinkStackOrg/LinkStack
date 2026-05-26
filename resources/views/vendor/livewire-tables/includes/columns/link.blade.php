<a href="{{ $path }}" {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}>
    @if($column->isHtml())
        {!! $title !!}
    @else
        {{ $title }}
    @endif
</a>
