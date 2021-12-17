@if(session('messages'))
    <div {{ $attributes }}>
        <ul class="mt-3 list-disc list-inside text-lg text-green-600">
            @foreach (session('messages') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
