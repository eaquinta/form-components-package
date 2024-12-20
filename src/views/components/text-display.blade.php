<link href="{{ asset('vendor/fcomponents/form-components.css') }}" rel="stylesheet">

@if($label !== false)    
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<div style="display: grid; width: 100%; overflow: hidden;">
    <div 
    id="{{ $prefixId }}{{ $name }}" 
    style="{{ $border ? 'border-bottom: 1px solid #ced4da;' : '' }} height: 25px; font-size: 14px; max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding: 0px 5px;"
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
