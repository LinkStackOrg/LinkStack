@aware([ 'tableName'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($this->getRows)"
    wire:key="{{ $tableName .'-secondary-header' }}"
>
    {{-- TODO: Remove --}}
    <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-test' }}" />

    @if ($this->showBulkActionsSections)
        <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.collapsed-columns :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'header-collapsed-hide' }}" rowIndex="-1"  />
    @endif

    @foreach($this->selectedVisibleColumns as $colIndex => $column)
        <x-livewire-tables::table.td.plain :column="$column" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-secondary-header-show-'.$column->getSlug() }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $this->getRows, $colIndex)">
            @if($column->hasSecondaryHeader() && $column->hasSecondaryHeaderCallback())
                @if( $column->secondaryHeaderCallbackIsFilter())
                    {{ $column->getSecondaryHeaderFilter($column->getSecondaryHeaderCallback(), $this->getFilterGenericData) }}    
                @elseif($column->secondaryHeaderCallbackIsString())
                    {{ $column->getSecondaryHeaderFilter($this->getFilterByKey($column->getSecondaryHeaderCallback()), $this->getFilterGenericData) }}
                @else
                    {{ $column->getNewSecondaryHeaderContents($this->getRows) }}
                @endif
            @endif
        </x-livewire-tables::table.td.plain>
    @endforeach
</x-livewire-tables::table.tr.plain>
