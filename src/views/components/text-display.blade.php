@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<div style="display: grid;">
    <div 
    id="{{ $prefixId }}{{ $name }}" 
    style="{{ $border ? 'border-bottom: 1px solid #ced4da;' : '' }} height: 25px; white-space: nowrap;"
    >{{ $value }}</div>
</div>

{{-- <input 
    type="text" 
    name="{{ $name }}" 
    id="{{ $prefixId }}{{ $name }}" 
    class="form-control rounded-1 bg-white {{ $label === false ? 'mt-1' : '' }} {{ $class ?? '' }}" 
    value="{{ $value }}"
    {{ $placeholder ? 'placeholder="' . __($label) . '"' : ''}} 
    {{ $readOnly ? 'disabled readonly' : ''}}>
<div class="invalid-feedback"></div> --}}
