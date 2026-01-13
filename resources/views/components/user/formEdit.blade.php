@props(['users'])

<div class="h-full w-[550px] overflow-y-auto px-5 py-5">

    <form action="{{ route('update_user', $users->uid) }}" method="POST">
        @csrf @method('PUT')
        <div class="py-1">
            <label for="name" class="text-xs uppercase tracking-wider">full name</label>
            <input type="text" value="{{ old('name', $users->name) }}" name="name"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="kareem maleek e.g">
        </div>

        <div class="py-1">
            <label for="email" class="text-xs uppercase tracking-wider">email</label>
            <input type="email" value="{{ old('email', $users->email) }}" name="email"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="john@mail.com">
        </div>

        <div class="py-1">
            <label for="role" class="text-xs uppercase tracking-wider">role</label>
            <select name="role"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]">
                <option disabled selected>Select role here...</option>
                <option value="1" {{ $users->role === 1 ? 'selected' : '' }}>Pharmacist</option>
                <option value="2" {{ $users->role === 2 ? 'selected' : '' }}>Doctor</option>

            </select>
        </div>

        <div class="py-1">
            <label for="status" class="text-xs uppercase tracking-wider">status</label>
            <select name="status"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]">
                <option disabled selected>Change status here...</option>
                <option value="active" {{ $users->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $users->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="py-1">
            <label for="password" class="text-xs uppercase tracking-wider">password</label>
            <input type="password" name="password"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="****** (if there are no changes, leave it blank)">
        </div>

        <div class="py-1">
            <label for="password_confirmation" class="text-xs uppercase tracking-wider">confirm password</label>
            <input type="password" name="password_confirmation"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="****** (if there are no changes, leave it blank)">
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
