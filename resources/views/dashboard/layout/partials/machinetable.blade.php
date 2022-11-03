<div class="rounded-md shadow-md bg-white">
    <div class="max-w-full mx-auto">
        <div class="flex flex-col">
            @if (empty($filter) || $filter == 'true')
                <div class="flex justify-end">
                    <form method="GET">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select onchange="this.form.submit()"
                            class="px-4 py-2 rounded-md bg-gray-100 focus:outline-gray-100 focus:bg-white focus:shadow-md transition duration-300 capitalize"
                            name="status" id="statusForm">
                            <option value="">semua</option>
                            <option value="sudah terkalibrasi" @if (request('status') === 'sudah terkalibrasi') selected @endif>sudah
                                terkalibrasi</option>
                            <option value="persiapan kalibrasi" @if (request('status') === 'persiapan kalibrasi') selected @endif>
                                persiapan kalibrasi</option>
                            <option value="kadaluarsa" @if (request('status') === 'kadaluarsa') selected @endif>kadaluarsa
                            </option>
                        </select>
                    </form>
                </div>
            @endif
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
                                        nama alat
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        merk
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        type
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        no. seri
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        kode alat
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        Kalibrasi Selanjutnya
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        status kalibrasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($slot->count() < 1)
                                    <tr
                                        class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                        <td colspan="8"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                            Tidak ada data di temukan
                                        </td>

                                    </tr>
                                @endif
                                @foreach ($slot as $item)
                                    <tr
                                        class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ ($slot->currentPage() - 1) * $slot->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                            <a class="hover:text-blue-400 transition duration-300"
                                                href="/dashboard/alat/{{ $item['id'] }}">{{ $item['nama_alat'] }}</a>
                                            <ul class="flex items-center gap-2 text-xs capitalize list-disc list-inside transition duration-300"
                                                style="visibility: hidden;">
                                                <li>
                                                    <a class="-ml-2 hover:text-blue-400 transition duration-300"
                                                        href="/dashboard/alat/{{ $item['id'] }}">detail</a>
                                                </li>
                                                <li>
                                                    <a class="-ml-2 hover:text-blue-400 transition duration-300"
                                                        href="/dashboard/alat/{{ $item['id'] }}/edit">edit</a>
                                                </li>
                                                <li>
                                                    <button id="show-modal-hapus-alat" data-id="{{ $item['id'] }}"
                                                        class="-ml-2 text-red-500">hapus</button>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $item['merk'] }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap uppercase">
                                            {{ $item['type'] }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap uppercase">
                                            {{ $item['no_seri'] }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap uppercase">
                                            {{ $item['kode_alat'] }}
                                        </td>
                                        @if ($item->jadwal->count() > 0)
                                            <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                                {{ Carbon\Carbon::parse($item->jadwal->first()->jadwal_kalibrasi)->format('d, F Y') }}
                                            </td>
                                        @else
                                            <td colspan="1"
                                                class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize text-center">
                                                -
                                            </td>
                                        @endif
                                        @if ($item->status_kalibrasi)
                                            <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="py-1.5 rounded-md @if ($item->status_kalibrasi === 'sudah terkalibrasi') bg-green-500 px-4
@elseif($item->status_kalibrasi === 'kadaluarsa')
bg-red-500 px-10 @else bg-blue-500 px-4 @endif text-white capitalize">
                                                    {{ $item->status_kalibrasi }}
                                                </span>
                                            </td>
                                        @else
                                            <td colspan="1"
                                                class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize text-center">
                                                -
                                            </td>
                                        @endif
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
@component('dashboard.layout.partials.modalwarning')
@endcomponent