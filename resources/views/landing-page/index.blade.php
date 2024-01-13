<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<!-- Page Content -->
<main>
    <div class="flex p-[30px] items-center">
        <div>
            <div class="bg-white p-8 rounded">

                <h1 class="text-4xl font-semibold mb-4 mt-[100px]">ToDo App</h1>

                <p class="text-gray-600 mb-8">Tigkatkan produktifitas anda dengan Todo App</p>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Kenapa Todo App?</h2>
                    <ul>
                        <li class="mb-2">Anda bisa fokus pada tugas yang anda punya</li>
                        <li class="mb-2">Meningkatkan produktifitas</li>
                        <li class="mb-2">Memudahkan mengatur prioritas</li>
                    </ul>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Fitur</h2>
                    <ul>
                        <li class="mb-2">Buat board untuk mengemlompokan tugas</li>
                        <li class="mb-2">Undang teman Anda untuk berkolaborasi dalam satu board</li>
                        <li class="mb-2">Tampilan yang mudah digunakan</li>
                    </ul>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="{{{ route('login') }}}"
                       class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-green-300">Mulai Sekarang</a>
                </div>

            </div>
        </div>
        <div>
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/todo-list-5945263-4911411.png?f=webp">
        </div>
    </div>
    <div class="absolute bottom-10 left-10">
        © 10121917, Agista Septiyanto, IF9K
    </div>
</main>

</body>
</html>
