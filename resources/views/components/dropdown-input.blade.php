@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500
    focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    <option value="draft">Draft</option>
    <option value="published">Published</option>
    <option value="deleted">Deleted</option>
</select>
