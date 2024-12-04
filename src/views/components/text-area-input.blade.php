<label for="{{ $name }}" class="fw-500 fs-rem-80">
    {{ __($label) }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>
<textarea 
    class="form-control valid rounded-1 bg-white" 
    cols="{{ $cols }}"
    id="{{ $prefixId }}{{ $name }}" 
    name="{{ $name }}" 
    rows="{{ $rows }}" 
    {{ $placeholder ? 'placeholder="' . __($label) . '"' : ''}}
    aria-invalid="false"
    {{ $readOnly ? 'disabled readonly' : ''}}>
>
</textarea>
<div class="invalid-feedback"></div>
