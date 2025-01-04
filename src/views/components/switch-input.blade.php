<input type="hidden" name="{{ $name }}" value="0">
<div class="form-check form-switch">
    <input 
        class="form-check-input" 
        type="checkbox" 
        id="{{ $prefixId }}{{ $name }}" 
        name="{{ $name }}"
        value="{{ $value }}" 
        {{ $value ? 'checked' : '' }} 
        {{ $disabled ? 'disabled' : '' }}
    >
    <label 
        class="form-check-label fw-500 fs-rem-80" 
        for="{{ $name }}"
    >
    {{ __($label) }}
    </label>
</div>
