@if (session()->has('success'))

    <div>
        <success-button :message="{!! htmlspecialchars(json_encode(session('success')), ENT_QUOTES, 'UTF-8') !!}"></success-button>
    </div>
    {{-- @else
    <div>
        <success-button :message="'petit test'"></success-button>
    </div> --}}
@endif
