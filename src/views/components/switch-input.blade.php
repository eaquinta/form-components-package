<div class="mt-1">
    <input type="hidden" name="{{ $name }}" value="0">
    <div class="form-check form-switch {{ $class ?? '' }}">
        <input 
            class="form-check-input" 
            type="checkbox" 
            id="{{ $prefixId }}{{ $name }}" 
            name="{{ $name }}"
            value="{{ $value }}" 
            {{ $checked ? 'checked' : '' }} 
            {{ $disabled ? 'disabled' : '' }}
        >
        <label 
            class="form-check-label fw-500 fs-rem-80" 
            for="{{ $name }}"
        >
            {{ __($label) }}
        </label>
    </div>
    @if (!$readOnly)
        <div class="invalid-feedback"></div>
    @endif
</div>
