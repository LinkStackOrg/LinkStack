@aware([ 'row', 'rowIndex', 'tableName', 'primaryKey','isTailwind','isBootstrap'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $this->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

<td wire:key="{{ $tableName . '-table-td-'.$row->{$primaryKey}.'-'.$column->getSlug() }}"
    @if ($column->isClickable())
        @if($this->getTableRowUrlTarget($row) === 'navigate') wire:navigate href="{{ $this->getTableRowUrl($row) }}"
        @else onclick="window.open('{{ $this->getTableRowUrl($row) }}', '{{ $this->getTableRowUrlTarget($row) ?? '_self' }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class([
                    'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
                    'hidden' =>  $isTailwind && $column && $column->shouldCollapseAlways(),
                    'hidden md:table-cell' => $isTailwind && $column && $column->shouldCollapseOnMobile(),
                    'hidden lg:table-cell' => $isTailwind && $column && $column->shouldCollapseOnTablet(),
                    '' => $isBootstrap && ($customAttributes['default'] ?? true),
                    'd-none' => $isBootstrap && $column && $column->shouldCollapseAlways(),
                    'd-none d-md-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnMobile(),
                    'd-none d-lg-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnTablet(),
                    'laravel-livewire-tables-cursor' => $isBootstrap && $column && $column->isClickable(),
                ])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        {{ $slot }}
</td>
