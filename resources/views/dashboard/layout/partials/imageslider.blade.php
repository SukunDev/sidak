@if (count($image) > 0)
    <div class="relative group w-full h-[19rem] lg:w-[40rem] lg:h-[22.5rem] bg-black/60 rounded-lg lg:rounded-r-none">
        <div class="absolute inset-0 bg-black opacity-50 rounded-lg lg:rounded-r-none z-50 group-hover:hidden">
        </div>
        <button
            class="absolute inset-y-0 right-0 my-auto h-fit z-50 text-gray-400 hover:text-gray-300 active:text-gray-400 transition duration-300"
            onclick="moveSlide(1)">
            <svg class="w-14 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
            </svg>
        </button>
        <button
            class="absolute inset-y-0 left-0 my-auto h-fit z-50 text-gray-400 hover:text-gray-300 active:text-gray-400 transition duration-300"
            onclick="moveSlide(-1)">
            <svg class="w-14 fill-current flip" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
            </svg>
        </button>
        @foreach ($image as $item)
            <img onclick="window.open(this.src)"
                class="slide relative w-full h-full rounded-lg md:rounded-r-none object-cover group-hover:object-contain transition-all duration-300 z-40"
                role="button" src="{{ $item['path'] }}" alt="">
        @endforeach
        <script>
            // set the default active slide to the first one
            let slideIndex = 1;
            showSlide(slideIndex);

            // change slide with the prev/next button
            function moveSlide(moveStep) {
                showSlide(slideIndex += moveStep);
            }

            function showSlide(n) {
                let i;
                const slides = document.getElementsByClassName("slide");

                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }

                // hide all slides
                for (i = 0; i < slides.length; i++) {
                    slides[i].classList.add('hidden');
                }

                // show the active slide
                slides[slideIndex - 1].classList.remove('hidden');
            }
        </script>
    </div>
@endif
