@aware([ 'tableName'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getFooterTrAttributes($this->getRows)"
    wire:key="{{ $tableName .'-footer' }}"
>
    {{-- Adds a Column For Bulk Actions--}}
    @if (!$this->bulkActionsAreEnabled() || !$this->hasBulkActions())
        <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName . '-footer-bulkactions-1' }}" />
    @elseif ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain wire:key="{{ $tableName . '-footer-bulkactions-2' }}" />
    @endif

    {{-- Adds a Column If Collapsing Columns Exist --}}
    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.collapsed-columns :displayMinimisedOnReorder="true" rowIndex="-1" :hidden="true" wire:key="{{ $tableName.'-footer-collapse' }}" />
    @endif

    @foreach($this->selectedVisibleColumns as $colIndex => $column)
        <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true"  wire:key="{{ $tableName .'-footer-shown-'.$colIndex }}" :column="$column" :customAttributes="$this->getFooterTdAttributes($column, $this->getRows, $colIndex)">

            @if($column->hasFooter() && $column->hasFooterCallback())
                @if($column->footerCallbackIsFilter())
                    {{ $column->getFooterFilter($column->getFooterCallback(), $this->getFilterGenericData) }}
                @elseif($column->footerCallbackIsString())
                    {{ $column->getFooterFilter($this->getFilterByKey($column->getFooterCallback()), $this->getFilterGenericData) }}
                @else
                    {{ $column->getNewFooterContents($this->getRows) }}
                @endif
            @endif

        </x-livewire-tables::table.td.plain>
    @endforeach
</x-livewire-tables::table.tr.plain>
