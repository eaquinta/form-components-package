<label for="{{ $name }}" class="fw-500 fs-rem-80">
    {{ __($label) }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>
<input type="text" name="{{ $name }}" id="{{ $prefixId }}{{ $name }}" class="form-control rounded-1 bg-white" placeholder="{{ __($label) }}" {{ $readOnly ? 'disabled readonly' : ''}}>
@if (!$readOnly)
<div class="invalid-feedback"></div>
@endif
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="{{ $prefixId }}{{ $name }}" name="{{ $name }}">
    <label class="form-check-label" for="{{ $name }}">
        {{ __($label) }}
    </label>    
</div>
@if (!$readOnly)
<div class="invalid-feedback"></div>
@endif