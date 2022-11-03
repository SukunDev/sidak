<div class="max-w-full">
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <tbody>
                            @foreach ($items as $item)
                                <tr
                                    class="alat-hover bg-white transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                    <td class="px-6 py-2.5 w-10 whitespace-nowrap text-sm text-gray-700 capitalize">
                                        {{ $item['key'] }}
                                    </td>
                                    <td class="px-6 py-2.5 text-sm text-gray-500 capitalize">
                                        {!! $item['value'] !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
