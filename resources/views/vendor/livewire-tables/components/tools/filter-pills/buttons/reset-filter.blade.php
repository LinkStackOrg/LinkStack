@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
@props(['filterKey', 'filterPillData'])

@php
    
    $filterButtonAttributes = $filterPillData->getCalculatedCustomResetButtonAttributes($filterKey,$this->getFilterPillsResetFilterButtonAttributes);

@endphp
@if ($isTailwind)
    <button 
        {{
            $attributes->merge($filterButtonAttributes)
            ->class([
                'flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none' => $filterButtonAttributes['default-styling'],
                'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => $filterButtonAttributes['default-colors'],
            ])
            ->except(['default', 'default-colors', 'default-styling', 'default-text'])
        }}
    >
        <span class="sr-only">{{ __($localisationPath.'Remove filter option') }}</span>
        <x-heroicon-m-x-mark class="h-full" />
    </button>
@else
    <a
        href="#"
        x-on:click.prevent="resetSpecificFilter('{{ $filterKey }}')"
        {{
            $attributes->merge($filterButtonAttributes)
            ->class([
                'text-white ml-2' => $isBootstrap && $filterButtonAttributes['default-styling']
            ])
            ->except(['default', 'default-colors', 'default-styling', 'default-text'])
        }}
    >
        <span @class([
            'sr-only' => $isBootstrap4,
            'visually-hidden' => $isBootstrap5,
            ])>{{ __($localisationPath.'Remove filter option') }}
            </span>
        <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-tiny"  />
    </a>
@endif
