@props([
    'disabled' => false,
    'checked' => '',
    'value' => '',
])

<input
    value="{{ $value }}"
    type="radio"
    @if($checked == $value)
    checked
    @endif
    {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
/>