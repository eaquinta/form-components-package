@if($showLabel)
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<input type="date"
    name="{{ $name }}" 
    id="{{ $prefixId }}{{ $name }}"
    class="form-control rounded-1 bg-white" 
    placeholder="{{ __($label) }}"
    value="{{ $value ?? '' }}" 
    {{ $readOnly ? 'disabled readonly' : ''}}>
@if (!$readOnly)
    <div class="invalid-feedback"></div>
@endif
