<input type="hidden" name="{{ $name }}" value="0">
<div class="form-check">
    <input 
        class="form-check-input {{ $class }}"
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

{{-- <div class="form-group">
    <label for="require_matri_name" class="fw-500 fs-rem-80"></label>
    <div class="form-check mt-1">
        <input class="form-check-input" type="checkbox" id="require_matri_name" name="require_matri_name" checked>
        <label for="require_matri_name">asdf</label>
    </div>
</div> --}}