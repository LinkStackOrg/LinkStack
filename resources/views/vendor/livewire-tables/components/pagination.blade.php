@aware(['isTailwind','isBootstrap','isBootstrap4', 'isBootstrap5', 'localisationPath'])
@props(['currentRows'])
@includeWhen(
    $this->hasConfigurableAreaFor('before-pagination'), 
    $this->getConfigurableAreaFor('before-pagination'), 
    $this->getParametersForConfigurableArea('before-pagination')
)

<div {{ $this->getPaginationWrapperAttributesBag() }}>
    @if ($this->paginationVisibilityIsEnabled())
        @if ($isTailwind)
            <div class="mt-4 px-4 md:p-0 sm:flex justify-between items-center space-y-4 sm:space-y-0">
                <div>
                    @if ($this->paginationIsEnabled && $this->isPaginationMethod('standard') && $currentRows->lastPage() > 1 && $this->showPaginationDetails)
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                                <span>{{ __($localisationPath.'Showing') }}</span>
                                <span class="font-medium">{{ $currentRows->firstItem() }}</span>
                                <span>{{ __($localisationPath.'to') }}</span>
                                <span class="font-medium">{{ $currentRows->lastItem() }}</span>
                                <span>{{ __($localisationPath.'of') }}</span>
                                <span class="font-medium"><span x-text="paginationTotalItemCount"></span></span>
                                <span>{{ __($localisationPath.'results') }}</span>
                        </p>
                    @elseif ($this->paginationIsEnabled && $this->isPaginationMethod('simple') && $this->showPaginationDetails)
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            <span>{{ __($localisationPath.'Showing') }}</span>
                            <span class="font-medium">{{ $currentRows->firstItem() }}</span>
                            <span>{{ __($localisationPath.'to') }}</span>
                            <span class="font-medium">{{ $currentRows->lastItem() }}</span>
                        </p>
                    @elseif ($this->paginationIsEnabled && $this->isPaginationMethod('cursor'))
                    @else
                        @if($this->showPaginationDetails)
                            <p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                                <span>{{ __($localisationPath.'Showing') }}</span>
                                <span class="font-medium">{{ $currentRows->count() }}</span>
                                <span>{{ __($localisationPath.'results') }}</span>
                            </p>
                        @endif
                    @endif
                </div>

                @if ($this->paginationIsEnabled)
                    {{ $currentRows->links('livewire-tables::specific.tailwind.'.(!$this->isPaginationMethod('standard') ? 'simple-' : '').'pagination') }}
                @endif
            </div>
        @else
            @if ($this->paginationIsEnabled && $this->isPaginationMethod('standard') && $currentRows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $currentRows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div @class([
                        "col-12 col-md-6 text-center text-muted",
                        "text-md-right" => $isBootstrap4,
                        "text-md-end" => $isBootstrap5,
                        ])>
                        @if($this->showPaginationDetails)
                            <span>{{ __($localisationPath.'Showing') }}</span>
                            <strong>{{ $currentRows->count() ? $currentRows->firstItem() : 0 }}</strong>
                            <span>{{ __($localisationPath.'to') }}</span>
                            <strong>{{ $currentRows->count() ? $currentRows->lastItem() : 0 }}</strong>
                            <span>{{ __($localisationPath.'of') }}</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>{{ __($localisationPath.'results') }}</span>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled && $this->isPaginationMethod('simple'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $currentRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>

                    <div @class([
                        "col-12 col-md-6 text-center text-muted",
                        "text-md-right" => $isBootstrap4,
                        "text-md-end" => $isBootstrap5,
                    ])>
                        @if($this->showPaginationDetails)
                            <span>{{ __($localisationPath.'Showing') }}</span>
                            <strong>{{ $currentRows->count() ? $currentRows->firstItem() : 0 }}</strong>
                            <span>{{ __($localisationPath.'to') }}</span>
                            <strong>{{ $currentRows->count() ? $currentRows->lastItem() : 0 }}</strong>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled && $this->isPaginationMethod('cursor'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $currentRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                </div>
            @else
                <div class="row mt-3">
                    <div class="col-12 text-muted">
                        @if($this->showPaginationDetails)
                            {{ __($localisationPath.'Showing') }}
                            <strong>{{ $currentRows->count() }}</strong>
                            {{ __($localisationPath.'results') }}
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @endif
</div>

@includeWhen(
    $this->hasConfigurableAreaFor('after-pagination'), 
    $this->getConfigurableAreaFor('after-pagination'), 
    $this->getParametersForConfigurableArea('after-pagination')
)
