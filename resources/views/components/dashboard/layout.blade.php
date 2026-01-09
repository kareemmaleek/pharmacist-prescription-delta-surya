<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dashboard</title>
</head>
<body>
    @include('components._flashmessage')
    <div class="w-full h-dvh flex bg-[var(--bgColor)]">
        <div class="w-56 h-full bg-white">

            {{-- <form action="{{ route('proceed_logout') }}" method="POST">
                @csrf
                <button type="submit">LOGOUT</button>
            </form> --}}

            <div class="w-full h-full p-4 flex flex-col">
                <h1 class="py-3 mb-5 text-xl font-bold text-[var(--acsentColor)]">Medication Prescribing App</h1>
                <div class="flex-1 h-full">
                    <x-dashboard.navigation/>
                </div>
            </div>
        </div>

        <div class="flex-1 h-full ">
            {{ $slot }}
        </div>

    </div>
</body>
</html>
