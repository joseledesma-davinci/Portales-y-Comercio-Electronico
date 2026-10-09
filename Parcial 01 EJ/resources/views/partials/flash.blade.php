@if(session('success'))
    <div class="flash flash-success" role="status" aria-live="polite">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="flash flash-error" role="alert">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="flash flash-error" role="alert">
        <p>Revisá estos datos, che:</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
