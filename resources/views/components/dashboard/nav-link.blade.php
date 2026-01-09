@props(['active' => false])

<a {{ $attributes }}>
    <div
        class="{{ $active ? 'rounded-lg bg-green-50 text-[var(--acsentColor)]' : 'hover:rounded-lg hover:bg-green-50 hover:text-[var(--acsentColor)]' }} my-1 flex w-full items-center gap-2 p-2 px-5 "
    >
        {{ $slot }}
    </div>
</a>
