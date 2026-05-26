@aware([ 'tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['rowID', 'rowIndex'])

<x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-tbody-reorder-{{ $rowID }}" :displayMinimisedOnReorder="false">
    <svg
        x-cloak x-show="currentlyReorderingStatus"
        xmlns="http://www.w3.org/2000/svg"
        fill="none" stroke="currentColor"
        viewBox="0 0 24 24"
        @class([
            'inline w-4 h-4' => $isTailwind,
            'd-inline' => ($isBootstrap4 || $isBootstrap5),
        ])
        @style([
            'width:1em; height:1em;' => ($isBootstrap4 || $isBootstrap5),
        ])
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</x-livewire-tables::table.td.plain>
