@aware([ 'tableName','primaryKey', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['row', 'rowIndex'])

@php
    $tdAttributes = $this->getBulkActionsTdAttributes;
    $tdCheckboxAttributes = $this->getBulkActionsTdCheckboxAttributes;
@endphp

@if ($this->showBulkActionsSections())
    <x-livewire-tables::table.td.plain wire:key="{{ $tableName }}-tbody-td-bulk-actions-td-{{ $row->{$primaryKey} }}" :displayMinimisedOnReorder="true"  :customAttributes=$tdAttributes>
        <div @class([
            'inline-flex rounded-md shadow-sm' => $isTailwind,
            'form-check' => $isBootstrap5,
        ])>
            <x-livewire-tables::forms.checkbox 
                wire:key="{{ $tableName . 'selectedItems-'.$row->{$primaryKey} }}" 
                value="{{ $row->{$primaryKey} }}"
                :checkboxAttributes=$tdCheckboxAttributes
            />
        </div>
    </x-livewire-tables::table.td.plain>
@endif
