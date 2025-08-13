@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80 d-flex justify-content-between">
        <div>
            {{ __($label) }}
            @if($required)
                <span class="text-danger">{{ $requiredChar }}</span>
            @endif
        </div>
        @if($required && $requiredDisable)
            <div class="form-check form-switch d-inline ms-2 align-middle pb-0 mb-0" style="transform: scale(0.8); min-height: 19px;">
                <input class="form-check-input" type="checkbox" id="switch_required_{{ $name }}" data-bs-toggle="tooltip" data-bs-placement="top" title="campo requerido" checked tabindex="-1">
            </div>
        @endif
    </label>
@endif
<div class="input-group {{ $size ? 'input-group-' . $size : '' }} {{ $class ?? '' }}">
    <input 
        type="text" 
        name="{{ $name }}" 
        id="{{ $prefixId }}{{ $id ? $id : $name }}" 
        class="form-control bg-white text-end" 
        value="{{ $value }}" 
        {!! $placeholder ? 'placeholder="' . __($placeholderText ?? $label) . '"' : '' !!}
        {{ $readOnly ? 'readonly' : '' }} 
        {{ $disabled ? 'disabled' : '' }}
    >
    <select 
        class="form-select flex-grow-0 w-auto" 
        name="{{ $nameDimensional }}" 
        id="{{ $prefixId }}{{ $idDimensional ? $idDimensional : $nameDimensional }}"
        style="padding-right: 1.5rem !important;"
    >
        @foreach ($optionsList as $key => $optionValue)
            <option value="{{ $key }}" {{ $key == $valueDimensional ? 'selected' : '' }}>
                {{ __($optionValue) }}
            </option>
        @endforeach
    </select>
</div> 
<div class="invalid-feedback"></div>
