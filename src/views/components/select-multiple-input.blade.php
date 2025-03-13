@if($label !== false)
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<select class="form-select {{ $class }}" name="{{ $name }}[]" id="{{ $prefixId }}{{ $name }}" multiple="multiple" data-placeholder="{{ __($label) }}"></select>
@if (!$readOnly)
<div class="invalid-feedback"></div>
@endif