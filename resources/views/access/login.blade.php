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

    <title>Access Page</title>
</head>

<body>
    @include('components._flashmessage')

    <div class="flex h-dvh w-full bg-[var(--bgColor)]">
        <div
            class="flex h-full w-full items-center justify-center bg-[var(--acsentColor)] p-4 md:p-0 lg:w-[550px] lg:bg-white">
            <div class="h-fit w-[400px] rounded-lg bg-white p-5 shadow-md lg:bg-none lg:p-0 lg:shadow-none">
                <h1 class="text-xl font-bold text-[var(--acsentColor)]">Medication Prescribing App</h1>

                <h2 class="my-3 text-xl font-bold">Log In</h2>
                <p class="text-xs text-gray-400">Log in to access the application, so you can operate the prescription
                    app.</p>

                <form action="" method="POST">
                    @csrf

                    <div class="mt-6 py-1">
                        <label for="email" class="text-xs font-medium uppercase tracking-wider">Email Address</label>
                        <input type="email" name="email"
                            class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="kareem@mail.com">
                    </div>

                    <div class="py-1">
                        <label for="password" class="text-xs font-medium uppercase tracking-wider">password</label>
                        <input type="password" name="password"
                            class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="********">
                    </div>

                    <button type="submit"
                        class="my-2 w-full cursor-pointer rounded-md bg-[var(--acsentColor)] px-4 py-2 text-center font-medium text-white hover:opacity-90">Log
                        me in</button>

                </form>

            </div>

        </div>
        <div class="hidden lg:block lg:h-full lg:flex-1">
            <div class="relative h-full w-full bg-[var(--acsentColor)] lg:bg-none">

                <img src="{{ asset('build/assets/images/access-bg.jpg') }}" alt="access-bg"
                    class="absolute inset-0 h-full w-full object-cover opacity-30">

            </div>
        </div>
    </div>
</body>

</html>
