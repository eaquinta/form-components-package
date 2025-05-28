@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<input 
    type="number" 
    name="{{ $name }}" 
    id="{{ $prefixId }}{{ $id ? $id : $name }}" 
    class="form-control rounded-1 bg-white {{ $label === false ? 'mt-1' : '' }} {{ $class ?? '' }}" 
    value="{{ $value }}"
    {{ $placeholder ? 'placeholder="' . __($label) . '"' : '' }} 
    {{ $readOnly ? 'readonly' : '' }} 
    {{ $disabled ? 'disabled' : '' }}
    {{ $min !== null ? 'min="' . $min . '"' : '' }}
    {{ $max !== null ? 'max="' . $max . '"' : '' }}
    {{ $step !== null ? 'step="' . $step . '"' : '' }}
>    
<div class="invalid-feedback"></div>