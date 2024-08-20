@props(['categories', 'level' => 0])

@foreach ($categories as $category)
<option value="{{ $category['id'] }}" class="ml-{{ $level * 2 }}">
    {!! str_repeat('&nbsp;', $level * 2) !!}{{ $category['plural_name'] }}
</option>
@if (array_key_exists('children', $category))
<x-lists.category-options-list :categories="$category['children']" :level="$level + 1" />
@endif
@endforeach

