<a href="{{ route('users') }}">
    <div
        class="{{ request()->is('users') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-fit cursor-pointer items-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in">
        <x-heroicon-o-users class="h-5 w-5" />
        <span class="font-medium">All User</span>
    </div>
</a>

<a href="{{ route('users_new') }}">
    <div
        class="{{ request()->is('users/new') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-fit cursor-pointer items-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in">
        <x-heroicon-o-user-plus class="h-5 w-5" />
        <span class="font-medium">New User</span>
    </div>
</a>
