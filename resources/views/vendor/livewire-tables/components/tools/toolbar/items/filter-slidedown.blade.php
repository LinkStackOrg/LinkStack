@aware([ 'tableName', 'isTailwind', 'isBootstrap'])
@props([])

<div x-cloak x-show="filtersOpen" {{ $attributes
            ->merge($this->getFilterSlidedownWrapperAttributes)
            ->merge($isTailwind ? [
                'x-transition:enter' => 'transition ease-out duration-100',
                'x-transition:enter-start' => 'transform opacity-0',
                'x-transition:enter-end' => 'transform opacity-100',
                'x-transition:leave' => 'transition ease-in duration-75',
                'x-transition:leave-start' => 'transform opacity-100',
                'x-transition:leave-end' => 'transform opacity-0',
            ] : [])
            ->class([
                'container' => $isBootstrap && ($this->getFilterSlidedownWrapperAttributes['default'] ?? true),
            ])
            ->except(['default','default-colors','default-styling'])
        }} 

>
    @foreach ($this->getFiltersByRow() as $filterRowIndex => $filtersInRow)
        @php($defaultAttributes = $this->getFilterSlidedownRowAttributes($filterRowIndex))
        <div {{ $attributes
            ->merge($defaultAttributes)
            ->merge([
                'row' => $filterRowIndex,
            ])
            ->class([
                'row col-12' => $isBootstrap && ($defaultAttributes['default-styling'] ?? true),
                'grid grid-cols-12 gap-6 px-4 py-2 mb-2' => $isTailwind && ($defaultAttributes['default-styling'] ?? true),
            ])
            ->except(['default','default-colors','default-styling'])
        }} 
        >
            @foreach ($filtersInRow as $filter)
                <div
                    @class([
                        'space-y-1 mb-4' =>
                            $isBootstrap,
                        'col-12 col-sm-9 col-md-6 col-lg-3' =>
                            $isBootstrap &&
                            !$filter->hasFilterSlidedownColspan(),
                        'col-12 col-sm-6 col-md-6 col-lg-3' =>
                            $isBootstrap &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() === 2,
                        'col-12 col-sm-3 col-md-3 col-lg-3' =>
                            $isBootstrap &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() === 3,
                        'col-12 col-sm-1 col-md-1 col-lg-1' =>
                            $isBootstrap &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() === 4,
                        'space-y-1 col-span-12' =>
                            $isTailwind,
                        'sm:col-span-6 md:col-span-4 lg:col-span-2' =>
                            $isTailwind &&
                            !$filter->hasFilterSlidedownColspan(),
                        'sm:col-span-12 md:col-span-8 lg:col-span-4' =>
                            $isTailwind &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() === 2,
                        'sm:col-span-9 md:col-span-4 lg:col-span-3' =>
                            $isTailwind &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() === 3,
                    ])
                    id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                >
                    {{ $filter->setGenericDisplayData($this->getFilterGenericData)->render() }}
                </div>
            @endforeach
        </div>
    @endforeach
</div>
