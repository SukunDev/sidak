<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ env('APP_NAME') }} - Login</title>
</head>

<body class="bg-[#181818]">
    @include('partials.alert')
    <div class="fixed inset-0 m-auto w-full md:w-1/3 h-fit">
        <div class="text-center text-white my-4 text-xl">
            <p>Login Sistem Informasi Database Kalibrasi (SIDAK)
                <span class="whitespace-nowrap">Lab. Elektro dan EMC</span>
            </p>
        </div>
        <div class="rounded-md bg-white px-6 py-6 shadow-md text-gray-700 space-y-4 font-Poppins">
            <div>
                <h1 class="text-2xl font-medium">Login</h1>
                <p>Masuk untuk menuju ke dashboard</p>
            </div>
            <form class="space-y-2" action="/auth/login" method="POST">
                @csrf
                <div class="flex flex-col">
                    <label class="font-medium capitalize" for="usernameForm">username</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-100 hover:outline-gray-200 focus:bg-white focus:outline-gray-200 focus:shadow-md transition duration-300"
                        type="text" name="username" id="usernameForm" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-medium capitalize" for="passwordForm">password</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-100 hover:outline-gray-200 focus:bg-white focus:outline-gray-200 focus:shadow-md transition duration-300"
                        type="password" name="password" id="passwordForm" required>
                </div>
                <div class="flex justify-center">
                    <button
                        class="w-1/2 py-2 rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 text-white transition duration-300">Masuk</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#alert button').on('click', function() {
                $(this).parent().remove()
            })
        })
    </script>
</body>

</html>
