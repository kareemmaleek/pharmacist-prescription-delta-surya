<div class="h-full w-full py-5 lg:w-[450px]">

    <form action="{{ route('create_new_patient') }}" method="POST">
        @csrf
        <div class="py-1">
            <label for="full_name" class="text-xs uppercase tracking-wider">full name</label>
            <input type="text" value="{{ old('full_name') }}" name="full_name"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="kareem maleek e.g">
        </div>

        <div class="py-1">
            <label for="phone_number" value="{{ old('phone_number') }}" class="text-xs uppercase tracking-wider">phone
                number</label>
            <input type="tel" name="phone_number"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="08xxxxxx e.g">
        </div>

        <div class="py-1">
            <button type="submit"
                class="my-2 flex w-full cursor-pointer items-center justify-center gap-2 rounded-md bg-[var(--acsentColor)] px-4 py-2 text-center font-medium text-white hover:opacity-90">
                <x-heroicon-o-check-circle class="h-5 w-5" />
                Submit
            </button>
        </div>
    </form>
</div>
