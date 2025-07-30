<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<input type="color" class="form-control form-control-color" name="{{ $name }}" id="{{ $prefixId }}{{ $id ? $id : $name }}" value="{{ $value }}">
<div class="invalid-feedback"></div>