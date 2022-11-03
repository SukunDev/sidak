<div id="modal-file-manager" style="display: none">
    <div class="fixed inset-0 bg-black opacity-70 z-[9999]">
    </div>
    <div class="fixed inset-0 m-auto  w-[calc(100%-24px)] md:w-[calc(100%-16rem)] lg:w-1/2 h-fit z-[9999]">
        <div class="w-full px-4 py-4 rounded-md bg-white border border-gray-200">
            <div class="flex items-center justify-between pb-4">
                <p class="text-xl font-medium">Upload Image</p>
                <button id="modal-file-manager-close"
                    class="text-gray-400 hover:text-gray-500 active:text-gray-400 transition duration-300">
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </button>
            </div>
            <form id="upload_form" enctype="multipart/form-data" method="post">
                <div class="flex justify-center items-center w-full">
                    <label for="dropzone-file"
                        class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" name="dropzone-file" onchange="uploadFile()"
                            class="hidden" />
                    </label>
                </div>
                <div class="my-4 w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div id="progressBar" class="h-4 bg-blue-600 rounded-full dark:bg-blue-500" style="width: 0%"></div>
                </div>
            </form>
            <p id="status" class="text-center px-4 py-2 rounded-md capitalize text-white cursor-pointer"
                onclick="this.style.display = 'none'" style="display: none"></p>
            <div class="max-h-80 overflow-hidden relative flex flex-col">
                <p class="text-gray-700 font-medium px-4 pt-4">List Gambar</p>
                <div id="list-gambar" class="flex-auto overflow-y-auto relative p-4">
                    @foreach ($detail['images'] as $item)
                        <div class="flex items-center justify-between py-1 border-b">
                            <div>
                                <a class="font-medium hover:text-blue-500 transition duration-300 text-gray-600"
                                    href="{{ $item['path'] }}">{{ $item['name'] }}</a>
                                <p class="text-gray-500 text-sm">
                                    {{ number_format(floor($item['size'] / 1024), 0, ',', '.') }} KB</p>
                            </div>
                            <button onclick="deleteimage({{ $item['id'] }},this)"
                                class="rounded-md bg-red-500 text-white">
                                <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            <script>
                function _(el) {
                    return document.getElementById(el);
                }

                function deleteimage(id, elem) {
                    var formdata = new FormData();
                    formdata.append("user_id", "{{ $user['id'] }}");
                    var ajax = new XMLHttpRequest();
                    ajax.addEventListener("load", complateDeleteHandler.bind(null, elem), false);
                    ajax.open("POST",
                        "/api/delete-image/" + id
                    );
                    ajax.send(formdata);
                }

                function uploadFile() {
                    var file = _("dropzone-file").files[0];
                    var formdata = new FormData();
                    formdata.append("dropzone-file", file);
                    formdata.append("alat_id", "{{ $detail['id'] }}");
                    formdata.append("user_id", "{{ $user['id'] }}");
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);
                    ajax.open("POST",
                        "/api/upload-image"
                    );
                    ajax.send(formdata);
                }

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    _("progressBar").style.width = Math.round(percent) + "%";
                }

                function completeHandler(event) {
                    const responseJson = JSON.parse(event.target.responseText);
                    if (responseJson.success == 'true') {
                        var listCard = document.createElement("div");
                        listCard.className = "flex items-center justify-between py-1 border-b"
                        var divContainer = document.createElement("div");
                        var linkImage = document.createElement("a");
                        linkImage.setAttribute("class", "font-medium hover:text-blue-500 transition duration-300 text-gray-600");
                        linkImage.setAttribute("href", responseJson.result.path);
                        linkImage.textContent = responseJson.result.name;
                        var pSize = document.createElement("p");
                        pSize.setAttribute("class", "text-gray-500 text-sm");
                        pSize.textContent = Math.floor(responseJson.result.size / 1024).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                            ".") + " KB";
                        divContainer.appendChild(linkImage)
                        divContainer.appendChild(pSize)
                        var buttonContainer = document.createElement("button");
                        buttonContainer.setAttribute("class", "rounded-md bg-red-500 text-white");
                        buttonContainer.setAttribute("onclick", "deleteimage(" + responseJson.result.id + ",this)");
                        buttonContainer.insertAdjacentHTML('beforeend',
                            '<svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" /></svg>'
                        );
                        listCard.appendChild(divContainer);
                        listCard.appendChild(buttonContainer);
                        _("list-gambar").appendChild(listCard);
                        _("status").innerHTML = "berhasil menyimpan gambar";
                        _("status").style.background = "rgb(34 197 94 / 1)"
                        _("status").style.display = "block"
                    } else {
                        _("status").innerHTML = responseJson.message;
                        _("status").style.background = "rgb(234 179 8  / 1)"
                        _("status").style.display = "block"
                    }
                    _("progressBar").style.width = "0%";
                }

                function errorHandler(event) {
                    _("status").innerHTML = "Upload Failed";
                    _("status").style.background = "rgb(220 38 38 / 1)"
                    _("status").style.display = "block"
                }

                function abortHandler(event) {
                    _("status").innerHTML = "Upload Aborted";
                    _("status").style.background = "rgb(220 38 38 / 1)"
                    _("status").style.diplay = "block"
                }

                function complateDeleteHandler(elem, event) {
                    const responseJson = JSON.parse(event.target.responseText);
                    if (responseJson.success == "true") {
                        elem.parentNode.remove()
                        _("status").innerHTML = responseJson.message;
                        _("status").style.background = "rgb(34 197 94 / 1)"
                        _("status").style.display = "block"
                    } else {
                        _("status").innerHTML = responseJson.message;
                        _("status").style.background = "rgb(234 179 8  / 1)"
                        _("status").style.display = "block"
                    }
                }
            </script>
        </div>
    </div>
</div>
