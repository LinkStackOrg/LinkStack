<div wire:key="filterComponents.{{ $filter->getKey() }}-wrapper">
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />
    <livewire:dynamic-component :is="$livewireComponent" :tableComponent="get_class($this)" :filterKey="$filter->getKey()" :$tableName :key="'filterComponents-'.$filter->getKey()" wire:model="filterComponents.{{ $filter->getKey() }}" />
</div>
