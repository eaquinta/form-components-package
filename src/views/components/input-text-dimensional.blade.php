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
<div class="input-group">
    <input 
        type="text" 
        name="{{ $name }}" 
        id="{{ $prefixId }}{{ $id ? $id : $name }}" 
        class="form-control rounded-top-start-1 rounded-bottom-start-1 bg-white {{ $label === false ? 'mt-1' : '' }} {{ $class ?? '' }}" 
        value="{{ $value }}" 
        style="width: 60%;"
        {!! $placeholder ? 'placeholder="' . __($placeholderText ?? $label) . '"' : '' !!}
        {{ $readOnly ? 'readonly' : '' }} 
        {{ $disabled ? 'disabled' : '' }}
    >
    <select class="form-select rounded-top-end-1 rounded-bottom-end-1" name="{{ $nameDimensional }}" id="{{ $prefixId }}{{ $nameDimensional }}">
        <!-- <option value="kg">kg</option>
        <option value="lbs">lbs</option> -->
        @foreach ($optionsList as $key => $optionValue)
            <option value="{{ $key }}" {{ $key == $valueDimensional ? 'selected' : '' }}>
                {{ __($optionValue) }}
            </option>
        @endforeach
    </select>
</div> 
<div class="invalid-feedback"></div>
