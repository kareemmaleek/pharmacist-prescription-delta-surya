<div class="h-full w-full overflow-y-auto px-2 py-5 md:px-5 lg:w-[550px]">

    <form action="{{ route('create_new_users') }}" method="POST">
        @csrf
        <div class="py-1">
            <label for="name" class="text-xs uppercase tracking-wider">full name</label>
            <input type="text" value="{{ old('name') }}" name="name"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="kareem maleek e.g">
        </div>

        <div class="py-1">
            <label for="username" class="text-xs uppercase tracking-wider">username</label>
            <input type="text" value="{{ old('username') }}" name="username"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="kareemo14045 e.g">
        </div>

        <div class="py-1">
            <label for="email" class="text-xs uppercase tracking-wider">email</label>
            <input type="email" value="{{ old('email') }}" name="email"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="john@mail.com">
        </div>

        <div class="py-1">
            <label for="role" class="text-xs uppercase tracking-wider">role</label>
            <select name="role"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]">
                <option disabled selected>Select role here...</option>
                <option value="1">Pharmacist</option>
                <option value="2">Doctor</option>

            </select>
        </div>

        <div class="py-1">
            <label for="password" value="{{ old('password') }}"
                class="text-xs uppercase tracking-wider">password</label>
            <input type="password" name="password"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="******">
        </div>

        <div class="py-1">
            <label for="password_confirmation" value="{{ old('confirm_password') }}"
                class="text-xs uppercase tracking-wider">confirm password</label>
            <input type="password" name="password_confirmation"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="******">
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
