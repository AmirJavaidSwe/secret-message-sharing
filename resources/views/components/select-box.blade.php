@props([
    'disabled' => false,
    'selected' => '',
    'options' => []
])


<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    @if($options->isEmpty())
    <option value="">Please register atleast one more user in the system to view recipients here</option>
    @else
    <option value="">Please select a recipient</option>
    @foreach ($options as $option)
        <option value="{{ $option->id }}" @if($option->id == $selected) selected @endif>
            {{ $option->name }}
        </option>
    @endforeach
    @endif
</select>