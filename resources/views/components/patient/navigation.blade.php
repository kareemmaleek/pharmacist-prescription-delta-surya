<a href="{{ route('patient') }}">
    <div
        class="{{ request()->is('patient') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-fit cursor-pointer items-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in">
        <x-heroicon-o-user-group class="h-5 w-5" />
        <span class="font-medium">All Patient</span>
    </div>
</a>

<a href="{{ route('new_patient') }}">
    <div
        class="{{ request()->is('patient/new-patient') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-fit cursor-pointer items-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in">
        <x-heroicon-o-user-plus class="h-5 w-5" />
        <span class="font-medium">New Patient</span>
    </div>
</a>
