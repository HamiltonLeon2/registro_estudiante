@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600" style="color:red;">{{ __('Oops! Ocurrió algo malo.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600" style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
