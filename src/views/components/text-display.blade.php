<link href="{{ asset('vendor/fcomponents/form-components.css') }}" rel="stylesheet">
{{ dd($inLine); }}
@if($label !== false)    
    <label for="{{ $name }}" 
        class="fw-500 fs-rem-80"
        style="{{ $inLine && $labelWidth ? 'display: inline-block; width: ' . $labelWidth . ';' : '' }} {{ $inLine ? 'margin-right: 10px;' : '' }}">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<div style="display: {{ $inLine ? 'inline-block' : 'grid' }}; width: 100%; overflow: hidden;">
    <div 
    id="{{ $prefixId }}{{ $name }}" 
    style="{{ $border ? 'border-bottom: 1px solid #ced4da;' : '' }} height: 25px; font-size: 14px; max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding: 0px 5px;"
    >{{ $value }}</div>
</div>