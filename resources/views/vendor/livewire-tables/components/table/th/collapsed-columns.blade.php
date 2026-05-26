@aware(['isTailwind', 'isBootstrap'])
@if ($this->collapsingColumnsAreEnabled && $this->hasCollapsedColumns)
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class([
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => $isTailwind,
                'sm:hidden' => $isTailwind && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'md:hidden' => $isTailwind && !$this->shouldCollapseOnMobile && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'lg:hidden' => $isTailwind && !$this->shouldCollapseAlways,
                'd-table-cell laravel-livewire-tables-reorderingMinimised' => $isBootstrap,
                'd-sm-none' => $isBootstrap && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'd-md-none' => $isBootstrap && !$this->shouldCollapseOnMobile && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'd-lg-none' => $isBootstrap && !$this->shouldCollapseAlways,
            ])
        }}></th>
@endif
