<label for="{{ $name }}" class="fw-500 fs-rem-80">
    {{ __($label) }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>
<select class="form-select" name="{{ $name }}[]" id="{{ $prefixId }}{{ $name }}" multiple="multiple" data-placeholder="{{ __($label) }}"></select>
@if (!$readOnly)
<div class="invalid-feedback"></div>
@endif