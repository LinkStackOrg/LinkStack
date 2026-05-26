@aware(['isTailwind', 'isBootstrap'])
@props(['direction' => 'none', 'customIconAttributes'])
<span @class([
        'relative flex items-center' => $isTailwind,
        'relative d-flex align-items-center' => $isBootstrap
    ])
>

    @if($isTailwind)
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
            @break
            @case('desc')
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}   />
                <x-heroicon-o-x-circle  {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />

            @break
            @default
                <x-heroicon-o-chevron-up-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key'])  }}  />
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
            @endswitch


    @else
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
                @break
            @case('desc')
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
            @break
            @default
                <x-heroicon-o-chevron-up-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
        @endswitch
    @endif
</span>
