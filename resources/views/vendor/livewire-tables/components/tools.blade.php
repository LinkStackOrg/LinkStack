@aware(['isTailwind','isBootstrap'])

<div {{
    $attributes->merge($this->getToolsAttributes)
        ->class([
            'flex-col' => $isTailwind && ($this->getToolsAttributes['default-styling'] ?? true),
            'd-flex flex-column' => $isBootstrap && ($this->getToolsAttributes['default-styling'] ?? true)
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</div>
