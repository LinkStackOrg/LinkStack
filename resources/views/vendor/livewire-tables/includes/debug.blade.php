<div>
    @if ($this->debugIsEnabled())
        <p><strong>{{ __($this->getLocalisationPath.'Debugging Values') }}:</strong></p>
        

        @if (! app()->runningInConsole())
            <div class="mb-4">@dump((new \Rappasoft\LaravelLivewireTables\DataTransferObjects\DebuggableData($this))->toArray())</div>
        @endif
    @endif
</div>
