<a href="{{ route('examination') }}" class="w-full md:w-auto">
    <div
        class="{{ request()->is('examination') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-full cursor-pointer items-center justify-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in md:w-fit md:justify-normal">
        <x-heroicon-o-user-group class="h-5 w-5" />
        <span class="text-xs font-medium md:text-sm">All Examination</span>
    </div>
</a>

@if (auth()->user()->role == 2 || auth()->user()->role == 0)
    <a href="{{ route('new_exam') }}" class="w-full md:w-auto">
        <div
            class="{{ request()->is('examination/new') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-full cursor-pointer items-center justify-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in md:w-fit md:justify-normal">
            <x-heroicon-o-user-plus class="h-5 w-5" />
            <span class="text-xs font-medium md:text-sm">New Examination</span>
        </div>
    </a>
@endif
