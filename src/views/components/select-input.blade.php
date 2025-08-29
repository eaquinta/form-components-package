@if($label !== false)
    <label for="{{ $name }}" class="fw-500 fs-rem-80">
        {{ __($label) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
        @isset($url)
            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                <i class="fas fa-link fs-rem-65"></i>
            </a>
        @endisset
    </label>
@endif
@isset($icon)
    <div class="input-group">
        <span class="input-group-text">
            <i class="{{ $icon }}" @isset($iconColor) style="color: {{ $iconColor }};" @endisset></i>
        </span>
        <select class="form-select {{ $class }}" name="{{ $name }}" id="{{ $prefixId }}{{ $id ? $id : $name }}" data-placeholder="{{ $placeholder ?? __($label) }}">
            @foreach ($optionsList as $key => $optionValue)
                <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>
                    {{ __($optionValue) }}
                </option>
            @endforeach
        </select>
    </div>
@else
    <select class="form-select {{ $class }}" name="{{ $name }}" id="{{ $prefixId }}{{ $id ? $id : $name }}" data-placeholder="{{ $placeholder ?? __($label) }}">
        @foreach ($optionsList as $key => $optionValue)
            <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>
                {{ __($optionValue) }}
            </option>
        @endforeach
    </select>
@endisset
@if (!$readOnly)
    <div class="invalid-feedback"></div>
@endif