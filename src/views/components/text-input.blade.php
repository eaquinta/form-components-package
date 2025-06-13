@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80 w-100">
        <div class="d-flex justify-content-between">
            <div>
                {{ __($label) }}
                @if($required)
                    <span class="text-danger">{{ $requiredChar }}</span>
                @endif
            </div>
            @if($required && $requiredDisable)
                <div class="form-check form-switch d-inline ms-2 align-middle pb-0 mb-0" style="transform: scale(0.8); min-height: 19px;">
                    <input class="form-check-input" type="checkbox" id="{{ $prefixId }}switch_required_{{ $id ? $id : $name }}" data-bs-toggle="tooltip" data-bs-placement="top" title="campo requerido" checked tabindex="-1">
                </div>
            @endif
        </div>        
    </label>
@endif
<input 
    type="text" 
    name="{{ $name }}" 
    id="{{ $prefixId }}{{ $id ? $id : $name }}" 
    class="form-control rounded-1 bg-white {{ $label === false ? 'mt-1' : '' }} {{ $class ?? '' }}" 
    value="{{ $value }}"
    {!! $placeholder ? 'placeholder="' . __($placeholderText ?? $label) . '"' : '' !!}
    {{ $readOnly ? 'readonly' : '' }} 
    {{ $disabled ? 'disabled' : '' }}
>    
<div class="invalid-feedback"></div>
