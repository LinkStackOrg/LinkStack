<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    <div @class([
        'rounded-md shadow-sm' => $isTailwind,
        'mb-3 mb-md-0 input-group' => $isBootstrap,
    ])>
        <input {!! $filter->getWireMethod('filterComponents.'.$filter->getKey()) !!} {{ 
                $filterInputAttributes->merge() 
                ->class([
                    'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),
                    'form-control' => $isBootstrap,
                ])
                ->except(['default-styling','default-colors']) 
            }} />
    </div>
</div>
