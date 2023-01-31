<div class="rounded-md shadow-md bg-white">
    <div class="max-w-full mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        nama
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        username
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-center capitalize">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($all_user->count() < 1)
                                    <tr
                                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium text-center">
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            belum ada user yang di tambahkan
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($all_user as $item)
                                    <tr
                                        class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ ($all_user->currentPage() - 1) * $all_user->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                            <a href="/admin/user/{{ $item->username }}">{{ $item->name }}</a>
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
                                            {{ $item->username }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                            <div class="flex items-center justify-center gap-4">
                                                <form action="/admin/user/{{ $item->username }}/status" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status"
                                                        value="{{ $item->active > 0 ? 'nonactive' : 'active' }}">
                                                    <button type="submit"
                                                        class="px-2 py-1 rounded-md text-white {{ $item->active > 0 ? 'bg-red-500 hover:bg-red-600 active:bg-red-500' : 'bg-green-500 hover:bg-green-600 active:bg-green-500' }} transition duration-300 capitalize">
                                                        {{ $item->active > 0 ? 'non aktifkan' : 'aktifkan' }}
                                                    </button>
                                                </form>
                                                <a onclick="return confirm('Apakah anda yakin ingin menghapus {{ $item->name }}?')"
                                                    class="px-2 py-1 rounded-md text-white bg-gray-500 hover:bg-gray-600 active:bg-gray-500 transition duration-300 capitalize"
                                                    href="/admin/user/{{ $item->id }}/hapus">Hapus</a>
                                            </div>
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
</div>
