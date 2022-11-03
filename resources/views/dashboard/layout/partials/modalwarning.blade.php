<div id="modal-hapus-alat" style="display: none">
    <div class="fixed inset-0 bg-black opacity-70 z-[9999]">
    </div>
    <div class="fixed inset-0 m-auto  w-[calc(100%-24px)] md:w-[calc(100%-16rem)] lg:w-1/2 h-fit z-[9999]">
        <div class="w-full px-6 py-6 rounded-md bg-white border border-gray-200">
            <div class="space-y-8 text-center">
                <div class="flex justify-center">
                    <div class="px-4 py-4 rounded-full border-4 border-red-500">
                        <svg class="w-16 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-2xl font-medium">Apakah Anda Yakin ?</p>
                    <p class="text-sm text-gray-500">Apakah anda yakin ingin menghapus data alat ini. Proses ini akan
                        menghapus semua data yang terekam di
                        dalam database alat ini</p>
                </div>
                <div class="flex justify-center items-center gap-4">
                    <button id="modal-hapus-alat-close"
                        class="px-6 py-2 rounded-md bg-gray-500 text-white hover:bg-gray-600 active:bg-gray-500 transition duration-300">Batalkan</button>
                    <a href="/dashboard/alat/hapus/"
                        class="px-6 py-2 rounded-md bg-red-500 text-white hover:bg-red-600 active:bg-red-500 transition duration-300">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
