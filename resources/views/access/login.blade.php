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
    
    <title>Access Page</title>
</head>
<body>
    @include('components._flashmessage')

    <div class="w-full h-dvh bg-[var(--bgColor)] flex ">
        <div class="w-[550px] h-full bg-white  flex items-center justify-center">
            <div class="w-[400px] h-fit">
                <h1 class="font-bold text-xl text-[var(--acsentColor)]">Pharmacist Prescription App</h1>

                <h2 class="text-xl my-3 font-bold">Log In</h2>
                <p class="text-xs text-gray-400">Log in to access the application, so you can operate the prescription app.</p>
                
                <form action="" method="POST">
                    @csrf

                    <div class="py-1 mt-6">
                        <label for="email" class="uppercase text-xs tracking-wider font-medium">Email Address</label>
                        <input type="email" name="email" class="w-full text-sm font-medium my-1 py-2 px-3 rounded-md outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                        placeholder="kareem@mail.com">
                    </div>

                    <div class="py-1">
                        <label for="password" class="uppercase text-xs tracking-wider font-medium">password</label>
                        <input type="password" name="password" class="w-full text-sm font-medium my-1 py-2 px-3 rounded-md outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                        placeholder="********">
                    </div>

                    <button type="submit" class="w-full my-2 py-2 px-4 text-center rounded-md bg-[var(--acsentColor)] text-white font-medium cursor-pointer hover:opacity-90">Log me in</button>

                </form>

            </div>
        
        </div>
        <div class="flex-1 h-full ">
            <div class="relative w-full h-full bg-[var(--acsentColor)]">

                <img src="{{ asset('build/assets/images/access-bg.jpg') }}" alt="access-bg" class="absolute inset-0 w-full h-full object-cover opacity-30">

            </div>
        </div>
    </div>
</body>
</html>