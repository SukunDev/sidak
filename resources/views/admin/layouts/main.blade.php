<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title }} | Sidak</title>
</head>

<body>
    <div class="text-gray-700">
        {{-- sidebar --}}
        @include('admin.layouts.partials.sidebar')
        {{-- Content --}}
        <div id="main-content" class="pl-0 md:pl-64">
            @include('admin.layouts.partials.stickyheadercontent')
            @include('partials.alert')
            <div class="px-4 md:px-8 py-4 space-y-8">
                <div class="space-y-1 font-sans">
                    <h1 class="text-3xl font-medium text-gray-600 capitalize">{{ $title }}</h1>
                    <ul class="flex flex-wrap items-center gap-2 font-light text-gray-500 capitalize">
                        <li>home</li>
                        @foreach ($breadcrumbs as $item)
                            <li>
                                <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
                                </svg>
                            </li>
                            @if ($loop->index == count($breadcrumbs) - 1)
                                <li class="text-gray-400"><a class="hover:text-gray-500 transition duration-300"
                                        href="/{{ $item['slug'] }}">{{ $item['name'] }}</a></li>
                            @else
                                <li class="text-gray-500"><a class="hover:text-gray-600 transition duration-300"
                                        href="/{{ $item['slug'] }}">{{ $item['name'] }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="font-Poppins space-y-8">
                    @yield('container')
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/dashboard.js') }}"></script>
</body>

</html>
