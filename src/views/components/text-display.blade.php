<link href="{{ asset('vendor/fcomponents/form-components.css') }}" rel="stylesheet">
@if($inLine)    
    <div class="d-flex align-items-center">
        @if($label !== false)
            <label for="{{ $name }}" class="fw-500 fs-rem-80" style="{{ $labelWidth ? 'width: ' . $labelWidth . ';' : '' }}">
                {{ __($label) }}
                @if($required)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif
        <div id="{{ $prefixId }}{{ $name }}" 
            style="flex-grow: 1; font-size: 14px; padding: 0px 5px;">
            {{ $value }}
        </div>
    </div>
@else
    @if($label !== false)    
    <label for="{{ $name }}" 
        class="fw-500 fs-rem-80"
        style="">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    @endif
    <div style="display: grid; width: 100%; overflow: hidden;">
        <div 
            id="{{ $prefixId }}{{ $name }}" 
            style="{{ $border ? 'border-bottom: 1px solid #ced4da;' : '' }} 
                height: 25px; 
                font-size: 14px; 
                max-width: 100%; 
                overflow: hidden; 
                text-overflow: ellipsis; 
                white-space: nowrap; 
                padding: 0px 5px;"
        >
            {{ $value }}
        </div>
    </div>
@endif


