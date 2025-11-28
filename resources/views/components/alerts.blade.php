
@if(session()->has($type))
    <div class="alert alert-{{$type}}" id="{{$type}}-alert">
        {{ session($type) }}
    </div>
@endif
