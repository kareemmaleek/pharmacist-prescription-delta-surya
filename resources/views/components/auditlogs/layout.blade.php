<x-dashboard.layout>
    <div class="flex h-full w-full flex-col gap-3 px-3">

        <div class="flex h-20 w-full items-center justify-center gap-4 rounded-b-md bg-white">
            <a href="{{ route('audit_logs') }}">
                <div
                    class="{{ request()->is('audit-logs') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-fit cursor-pointer items-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in">
                    <x-heroicon-o-document-magnifying-glass class="h-5 w-5" />
                    <span class="font-medium">All Logs</span>
                </div>
            </a>

        </div>

        <div class="flex flex-1 flex-col overflow-hidden bg-white p-5 pt-8">

            {{ $slot }}
        </div>
    </div>
</x-dashboard.layout>
