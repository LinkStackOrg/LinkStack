@props(['columnTitle' => '', 'customLabelAttributes' => ['default' => true]])
<span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>
    {{ $columnTitle }}
</span>
