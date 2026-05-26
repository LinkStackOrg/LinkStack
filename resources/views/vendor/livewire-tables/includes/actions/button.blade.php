<a {{ $attributes->merge()
            ->class([
                'justify-center text-center items-center inline-flex space-x-2 rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $isTailwind && ($attributes['default-styling'] ?? true),
                'focus:border-indigo-300 focus:ring-indigo-200' => $isTailwind && ($attributes['default-colors'] ?? true),
                'btn btn-sm btn-success' => $isBootstrap && ($attributes['default-styling'] ?? true),
                '' => $isBootstrap && ($attributes['default-colors'] ?? true),
            ])
            ->except(['default','default-styling','default-colors'])
        }}
           @if($action->hasWireAction())
            {{ $action->getWireAction() }}="{{ $action->getWireActionParams() }}"
           @endif
           @if($action->getWireNavigateEnabled())
            wire:navigate
           @endif
        >

        @if($action->hasIcon() && $action->getIconRight())
            <span {{ $action->getLabelAttributesBag() }}>{{ $action->getLabel() }}</span>
            <i {{ $action->getIconAttributes()
                    ->class([
                        'ms-1 '. $action->getIcon() => $isBootstrap,
                        'ml-1 '. $action->getIcon() => $isTailwind,
                    ])
                    ->except(['default','default-styling','default-colors'])
                }}
            ></i>
        @elseif($action->hasIcon() && !$action->getIconRight())
            <i {{ $action->getIconAttributes()
                    ->class([
                        'ms-1 '. $action->getIcon() => $isBootstrap,
                        'mr-1 '. $action->getIcon() => $isTailwind,
                    ])
                    ->except(['default','default-styling','default-colors'])
                }}
            ></i>
            <span {{ $action->getLabelAttributesBag() }}>{{ $action->getLabel() }}</span>
        @else
            <span {{ $action->getLabelAttributesBag() }}>{{ $action->getLabel() }}</span>
        @endif
</a>
