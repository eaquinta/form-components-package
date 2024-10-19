<label for="{{ $name }}" class="fw-500 fs-rem-80">
    {{ __($label) }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>

<select class="form-select" name="{{ $name }}" id="{{ $prefixId }}{{ $name }}" data-placeholder="{{ __($label) }}">
    @foreach ($optionsList as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>
@if (!$readOnly)
<div class="invalid-feedback"></div>
@endif