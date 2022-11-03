<div class="rounded-md shadow-md bg-white mt-4">
    <p class="text-center font-medium">History</p>
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
                                        Tanggal Kalibrasi Sebelumnya
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        Kalibrator
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        Tempat Kalibrasi
                                    </th>
                                    <th scope="col"
                                        class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                        Sertifikat Kalibrasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($detail->count() < 1)
                                    <tr
                                        class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center capitalize">
                                            belum ada catatan
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($detail as $item)
                                    <tr
                                        class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                            {{ Carbon\Carbon::parse($item->jadwal_kalibrasi)->format('d, F Y') }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $item->kalibrator }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $item->tempat_kalibrasi }}
                                        </td>
                                        <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                            @if ($item->sertifikat_kalibrasi)
                                                <div class="flex gap-1 justify-center text-xs">
                                                    <a class="px-1.5 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 active:bg-blue-600 transition duration-300 text-white"
                                                        href="/{{ $item->sertifikat_kalibrasi }}">
                                                        <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512">
                                                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                            <path
                                                                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zM432 456c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24z" />
                                                        </svg></a>
                                                    <a class="px-1.5 py-1.5 rounded-md bg-red-600 hover:bg-red-500 active:bg-red-600 transition duration-300 text-white"
                                                        href="/{{ Request::path() }}/hapus-sertifikat/{{ $item->id }}">
                                                        <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512">
                                                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="flex gap-1 justify-center text-xs">
                                                    <button data-id="{{ $item->id }}"
                                                        data-tanggal="{{ Carbon\Carbon::parse($item->jadwal_kalibrasi)->format('d, F Y') }}"
                                                        class="uploadSertifikat px-1.5 py-1.5 rounded-md bg-slate-800 hover:bg-slate-700 active:bg-slate-800 transition duration-300 text-white">
                                                        <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512">
                                                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                            <path
                                                                d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456c13.3 0 24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24s10.7 24 24 24z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endif
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
