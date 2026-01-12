<a href="{{ route('transaction') }}">
    <div
        class="{{ request()->is('transaction') ? 'bg-[var(--acsentColor)] text-white ring-1 ring-[var(--acsentColor)]' : 'ring-1 ring-[var(--acsentColor)] text-[var(--acsentColor)] hover:bg-[var(--acsentColor)] hover:text-white' }} flex w-fit cursor-pointer items-center gap-2 rounded-md p-2 px-4 text-sm transition ease-in">
        <x-heroicon-o-banknotes class="h-5 w-5" />
        <span class="font-medium">All Transaction</span>
    </div>
</a>
