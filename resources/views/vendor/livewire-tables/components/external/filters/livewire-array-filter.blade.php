<div x-data x-init="$dispatch('filter-pills-updated', { filterPillValues: @js($returnValues), tableComponent: @js($tableComponent) })"
    >
    {{ $slot }}
</div>