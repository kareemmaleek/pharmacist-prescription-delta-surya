<x-dashboard.layout>
    <div class="flex h-full w-full flex-col gap-3 px-3">

        <div class="flex h-20 w-full items-center justify-center gap-4 rounded-b-md bg-white">
            <x-user.navigation />
        </div>

        <div class="flex flex-1 flex-col overflow-hidden bg-white p-5 pt-8">

            {{ $slot }}
        </div>
    </div>
</x-dashboard.layout>
