@aware([ 'tableName','isTailwind','isBootstrap'])
@props(['rowIndex', 'hidden' => false])

@if ($this->collapsingColumnsAreEnabled && $this->hasCollapsedColumns)
    <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
        {{
            $attributes
                ->merge()
                ->class([
                    'p-3 table-cell text-center' => $isTailwind,
                    'sm:hidden' => $isTailwind && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet(),
                    'md:hidden' => $isTailwind && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet() && $this->shouldCollapseOnMobile(),
                    'lg:hidden' => $isTailwind && !$this->shouldCollapseAlways() && ($this->shouldCollapseOnTablet() || $this->shouldCollapseOnMobile()),
                    'd-sm-none' => $isBootstrap && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet(),
                    'd-md-none' => $isBootstrap && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet() && $this->shouldCollapseOnMobile(),
                    'd-lg-none' => $isBootstrap && !$this->shouldCollapseAlways() && ($this->shouldCollapseOnTablet() || $this->shouldCollapseOnMobile()),
                ])
        }}
        :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
    >
        @if (! $hidden)
            <button
                x-cloak x-show="!currentlyReorderingStatus"
                x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $tableName }}', 'row': {{ $rowIndex }}}); open = !open"
                @class([
                    'border-0 bg-transparent p-0' => $isBootstrap
                ])
            >
                <x-heroicon-o-plus-circle x-cloak x-show="!open" {{ 
                    $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                        ->class([
                            'h-6 w-6' => $isTailwind && ($this->getCollapsingColumnButtonExpandAttributes['default-styling'] ?? true),
                            'text-green-600' => $isTailwind && ($this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true),
                            'laravel-livewire-tables-btn-lg text-success' => $isBootstrap && ($this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true)
                        ])
                        ->except(['default','default-styling','default-colors']) 
                    }}
                />
                <x-heroicon-o-minus-circle x-cloak x-show="open"  {{ 
                    $attributes->merge($this->getCollapsingColumnButtonCollapseAttributes)
                        ->class([
                            'h-6 w-6' => $isTailwind && ($this->getCollapsingColumnButtonCollapseAttributes['default-styling'] ?? true),
                            'text-yellow-600' => $isTailwind && ($this->getCollapsingColumnButtonCollapseAttributes['default-colors'] ?? true),
                            'laravel-livewire-tables-btn-lg text-warning' => $isBootstrap && ($this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true),
                        ])
                        ->except(['default','default-styling','default-colors']) 
                    }}
                />
            </button>
        @endif 
    </td>
@endif
