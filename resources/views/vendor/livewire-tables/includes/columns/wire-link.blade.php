<button
    {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
    @if($column->hasConfirmMessage())
        wire:confirm="{{ $column->getConfirmMessage() }}"
    @endif
    @if($column->hasActionCallback())
        wire:click="{{ $path }}"
    @endif
>{{ $title }}</button>
