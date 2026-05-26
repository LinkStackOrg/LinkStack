@aware([ 'tableName'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table', 'isTailwind' => false, 'isBootstrap' => false, 'isBootstrap4' => false, 'isBootstrap5' => false, 'for' => null])

@php
    $filterLabelAttributes = $filter->getFilterLabelAttributes();
    $customLabelAttributes = $filter->getLabelAttributes();
@endphp

@if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
    @include($filter->getCustomFilterLabel(),['filter' => $filter, 'filterLayout' => $filterLayout, 'tableName' => $tableName, 'isTailwind' => $isTailwind, 'isBootstrap' => $isBootstrap, 'isBootstrap4' => $isBootstrap4, 'isBootstrap5' => $isBootstrap5, 'customLabelAttributes' => $customLabelAttributes])
@elseif(!$filter->hasCustomPosition())
    <label for="{{ $for ?? $tableName.'-filter-'.$filter->getKey() }}" {{
            $attributes->merge($customLabelAttributes)->merge($filterLabelAttributes)
                ->class([
                    'block text-sm font-medium leading-5' => $isTailwind && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true)),
                    'text-gray-700 dark:text-white' => $isTailwind && ($filterLabelAttributes['default-colors'] ?? ($filterLabelAttributes['default'] ?? true)),
                    'd-block' => $isBootstrap && $filterLayout === 'slide-down' && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true)),
                    'mb-2' => $isBootstrap && $filterLayout === 'popover' && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true)),
                ])
                ->except(['default', 'default-colors', 'default-styling'])
        }}
    >
        {{ $filter->getName() }}
    </label>
@endif
