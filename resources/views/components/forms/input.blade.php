<label for="{{ $name }}" class="form-label">{{ $label ?? $name }}</label>
<input {{ $attributes->merge(['type' => 'text']) }}
name="{{ $name }}"
value="{{old($name)}}"
class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
>
@error($name)
<div class="invalid-feedback d-inline">{{ $message }}</div>
@enderror

