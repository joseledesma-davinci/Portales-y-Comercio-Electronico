@if(session()->has('feedback.message'))
    <div class="flash flash-success" role="status" aria-live="polite">
        {{ session('feedback.message') }}
    </div>
@endif

@if(session()->has('feedback.error'))
    <div class="flash flash-error" role="alert">
        {{ session('feedback.error') }}
    </div>
@endif
