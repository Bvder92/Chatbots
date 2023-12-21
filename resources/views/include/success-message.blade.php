@if (session()->has('success'))

    <div>
        <success-button :message="{!! htmlspecialchars(json_encode(session('success')), ENT_QUOTES, 'UTF-8') !!}"></success-button>
    </div>
@endif
