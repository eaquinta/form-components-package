@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<input 
    type="text" 
    name="{{ $name }}" 
    id="{{ $prefixId }}{{ $name }}" 
    class="form-control rounded-1 bg-white {{ $label === false ? 'mt-1' : '' }}" 
    value="{{ $value }}"
    {{ $placeholder ? 'placeholder="' . __($label) . '"' : ''}} 
    {{ $readOnly ? 'disabled readonly' : ''}}>
<div class="invalid-feedback"></div>
