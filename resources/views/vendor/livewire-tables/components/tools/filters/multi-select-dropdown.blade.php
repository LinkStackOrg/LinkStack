<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    @if ($isTailwind)
    <div class="rounded-md shadow-sm">
    @endif
        <select multiple
            {!! $filter->getWireMethod('filterComponents.'.$filter->getKey()) !!} {{ 
                $filterInputAttributes->merge([
                    'wire:key' => $filter->generateWireKey($tableName, 'multiselectdropdown'),
                ])
                ->class([
                    'block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),
                    'form-control' => $isBootstrap4 && ($filterInputAttributes['default-styling'] ?? true),
                    'form-select' => $isBootstrap5 && ($filterInputAttributes['default-styling'] ?? true),
                ])
                ->except(['default-styling','default-colors']) 
            }}>
        @if ($filter->getFirstOption() !== '')
            <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
        @endif
            @foreach($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    @if ($isTailwind)
    </div>
    @endif
</div>
