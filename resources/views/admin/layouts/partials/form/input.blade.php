<div class="flex flex-col">
    <label class="capitalize font-medium" for="{{ $id }}">{!! $label !!}</label>
    <input
        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
        type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
        @if (!empty($required)) required @endif>
</div>
