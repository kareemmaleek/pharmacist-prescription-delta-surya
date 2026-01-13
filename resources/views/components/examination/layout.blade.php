<x-dashboard.layout>
    <div class="flex h-full w-full flex-col gap-3 px-3">

        <div
            class="flex h-fit w-full flex-wrap items-center justify-center gap-2 rounded-b-md bg-white p-4 md:h-20 md:gap-4 md:p-0 lg:flex-nowrap">
            <x-examination.navigation />
        </div>

        <div class="flex flex-1 flex-col overflow-hidden bg-white p-5 pt-8">

            {{ $slot }}
        </div>
    </div>
</x-dashboard.layout>
