@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<input
    type="file"
    name="{{ $name }}{{ $multiple ? '[]' : '' }}"
    id="{{ $prefixId }}{{ $id ? $id : $name }}"
    class="form-control rounded-1 bg-white {{ $label === false ? 'mt-1' : '' }} {{ $class }}"
    {{ $placeholder ? 'placeholder="' . __($label) . '"' : '' }}
    {{ $readOnly ? 'readonly' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $accept ? 'accept="' . $accept . '"' : '' }}
    {{ $multiple ? 'multiple' : '' }}
>
<div class="invalid-feedback"></div>