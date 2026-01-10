<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dashboard</title>
</head>

<body>
    @include('components._flashmessage')
    <div class="flex h-dvh w-full bg-[var(--bgColor)]">
        <div class="h-full w-56 bg-white">

            {{-- <form action="{{ route('proceed_logout') }}" method="POST">
                @csrf
                <button type="submit">LOGOUT</button>
            </form> --}}

            <div class="flex h-full w-full flex-col p-4">
                <h1 class="mb-5 py-3 text-xl font-bold text-[var(--acsentColor)]">Medication Prescribing App</h1>
                <div class="h-full flex-1">
                    <x-dashboard.navigation />
                </div>
            </div>
        </div>

        <div class="h-full flex-1">
            {{ $slot }}
        </div>

    </div>

    <script src="/js/jquery.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
