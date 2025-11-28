@props([
      'name', 'value' => ''
])

<textarea name ={{$name}}
       value="{{ old("$name", $value )}}"
       class="form-control @error("$name") is-invalid @enderror" >{{ old("$name", $value )}}
    </textarea>
@error($name)
<div
    class="invalid-feedback">
    {{$message}}
</div>
@enderror
