@aware([ 'tableName', 'primaryKey','isTailwind','isBootstrap'])
@props(['row', 'rowIndex'])

@if ($this->collapsingColumnsAreEnabled && $this->hasCollapsedColumns)
    @php($customAttributes = $this->getTrAttributes($row, $rowIndex))
    <tr x-data
        @toggle-row-content.window="($event.detail.tableName === '{{ $tableName }}' && $event.detail.row === {{ $rowIndex }}) ? $el.classList.toggle('{{ $isBootstrap ? 'd-none' : 'hidden' }}') : null"
        {{
            $attributes->merge([
                    'wire:loading.class.delay' => 'opacity-50 dark:bg-gray-900 dark:opacity-60',
                    'wire:key' => $tableName.'-row-'.$row->{$primaryKey}.'-collapsed-contents',
                ])
                ->merge($customAttributes)
                ->class([
                    'hidden bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => ($isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
                    'hidden bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => ($isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
                    'd-none bg-light rappasoft-striped-row' => ($isBootstrap && $rowIndex % 2 === 0 && ($customAttributes['default'] ?? true)),
                    'd-none bg-white rappasoft-striped-row' => ($isBootstrap && $rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true)),
                ])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        <td colspan="{{ $this->getColspanCount }}" @class([
                'text-left pt-4 pb-2 px-4' => $isTailwind,
                'text-start pt-3 p-2' => $isBootstrap,
        ])>
            <div>
                @foreach($this->getCollapsedColumnsForContent as $colIndex => $column)

                    <p wire:key="{{ $tableName }}-row-{{ $row->{$primaryKey} }}-collapsed-contents-{{ $colIndex }}" @class([
                            'block mb-2' => $isTailwind,
                            'sm:block' => $isTailwind && $column->shouldCollapseAlways(),
                            'sm:block md:hidden' => $isTailwind && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && $column->shouldCollapseOnMobile(),
                            'sm:block lg:hidden' => $isTailwind && !$column->shouldCollapseAlways() && ($column->shouldCollapseOnTablet() || $column->shouldCollapseOnMobile()),

                            'd-block mb-2' => $isBootstrap,
                            'd-sm-none' => $isBootstrap && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && !$column->shouldCollapseOnMobile(),
                            'd-md-none' => $isBootstrap && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && $column->shouldCollapseOnMobile(),
                            'd-lg-none' => $isBootstrap && !$column->shouldCollapseAlways() && ($column->shouldCollapseOnTablet() || $column->shouldCollapseOnMobile()),
                    ])>
                        <strong>{{ $column->getTitle() }}</strong>: 
                        @if($column->isHtml())
                            {!! $column->setIndexes($rowIndex, $colIndex)->renderContents($row) !!}
                        @else
                            {{ $column->setIndexes($rowIndex, $colIndex)->renderContents($row) }}
                        @endif
                    </p>
                @endforeach
            </div>
        </td>
    </tr>
@endif
