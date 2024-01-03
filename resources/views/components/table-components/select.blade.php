@if($user->id == 1)
<input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled="">
@else
<div class="form-check">
    <input wire:model="selected" wire:loading.attr.delay="disabled" data-id="{{ $user->id }}" value="{{ $user->id }}" type="checkbox" class="form-check-input">
</div>
@endif