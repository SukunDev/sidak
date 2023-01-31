<div id="modal-upload-sertifikat" style="display: none">
    <div class="fixed inset-0 bg-black opacity-70 z-[9999]">
    </div>
    <div class="fixed inset-0 m-auto w-[calc(100%-24px)] md:w-[calc(100%-16rem)] lg:w-1/2 h-fit z-[9999]">
        <div class="w-full px-4 py-4 rounded-md bg-white border border-gray-200">
            <div class="flex items-center justify-between">
                <p id="title" class="text-xl font-medium">Upload Sertifikat Kalibrasi Pada Tanggal</p>
                <button id="modal-upload-sertifikat-close"
                    class="text-gray-400 hover:text-gray-500 active:text-gray-400 transition duration-300">
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </button>
            </div>
            <form class="space-y-4" action="/{{ Request::path() }}/upload-sertifikat" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="idForm" value="1">
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="kalibratorForm">kalibrator</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="kalibrator" id="kalibratorForm" required>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="tempatKalibrasiForm">Tempat Kalibrasi</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="tempat_kalibrasi" id="tempatKalibrasiForm" required>
                </div>
                <div id="kebersamaanForm" class="flex flex-col" style="display: none">
                    <p class="capitalize font-medium">upload keberterimaan </p>
                    <label class="block">
                        <span class="sr-only">Choose File</span>
                        <input type="file"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-700 file:text-white hover:file:bg-slate-600"
                            name="keberterimaan" />
                    </label>
                </div>
                <div id="sertifikatForm" class="flex flex-col" style="display: none">
                    <p class="capitalize font-medium">upload sertifikat</p>
                    <label class="block">
                        <span class="sr-only">Choose File</span>
                        <input type="file"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-700 file:text-white hover:file:bg-slate-600"
                            name="sertifikat_kalibrasi" />
                    </label>
                </div>
                <div class="flex justify-center">
                    <button
                        class="w-1/2 py-2 rounded-md bg-green-500 text-white hover:bg-green-600 active:bg-green-500 transition duration-300"
                        type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
