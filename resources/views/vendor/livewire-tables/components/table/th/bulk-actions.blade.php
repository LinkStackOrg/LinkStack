@aware(['tableName','isTailwind', 'isBootstrap'])
@php
    $customAttributes = $this->hasBulkActionsThAttributes ? $this->getBulkActionsThAttributes : $this->getAllThAttributes($this->getBulkActionsColumn())['customAttributes'];
    $bulkActionsThCheckboxAttributes = $this->getBulkActionsThCheckboxAttributes();
@endphp

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <x-livewire-tables::table.th.plain  :displayMinimisedOnReorder="true" wire:key="{{ $tableName }}-thead-bulk-actions" :$customAttributes>
        <div
            x-data="{newSelectCount: 0, indeterminateCheckbox: false, bulkActionHeaderChecked: false}"
            x-init="$watch('selectedItems', value => indeterminateCheckbox = (value.length > 0 && value.length < paginationTotalItemCount))"
            x-cloak x-show="currentlyReorderingStatus !== true"
            @class([
                'inline-flex rounded-md shadow-sm' => $isTailwind,
                'form-check' => $isBootstrap,
            ])
        >
            <input
                x-init="$watch('indeterminateCheckbox', value => $el.indeterminate = value); $watch('selectedItems', value => newSelectCount = value.length);"
                x-on:click="if(selectedItems.length == paginationTotalItemCount) { $el.indeterminate = false; $wire.clearSelected(); bulkActionHeaderChecked = false; } else { bulkActionHeaderChecked = true; $el.indeterminate = false; $wire.setAllSelected(); }"
                type="checkbox"
                :checked="selectedItems.length == paginationTotalItemCount"
                {{
                    $attributes->merge($bulkActionsThCheckboxAttributes)->class([
                        'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => $isTailwind && (($bulkActionsThCheckboxAttributes['default'] ?? true) || ($bulkActionsThCheckboxAttributes['default-colors'] ?? true)),
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 ' => $isTailwind && (($bulkActionsThCheckboxAttributes['default'] ?? true) || ($bulkActionsThCheckboxAttributes['default-styling'] ?? true)),
                        'form-check-input' => $isBootstrap && ($bulkActionsThCheckboxAttributes['default'] ?? true),
                    ])->except(['default','default-styling','default-colors'])
                }}
            />
        </div>
    </x-livewire-tables::table.th.plain>
@endif