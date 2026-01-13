@props(['users'])

<div class="relative my-3 w-full flex-1 overflow-auto rounded-lg border">
    <table class="w-full text-left text-sm">
        <thead class="text-body sticky top-0 z-10 border-b bg-green-50 text-sm">
            <tr>
                <th scope="col" class="px-6 py-2 font-medium">
                    Name
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Username
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Email
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Role
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Status
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Created At
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-b bg-white hover:bg-green-100">
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $user->name }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $user->username }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $user->email }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-bold">
                        <div
                            class="{{ $user->role === 1 ? 'bg-violet-100 text-violet-700' : ($user->role === 2 ? 'bg-pink-100 text-pink-700' : 'bg-orange-100 text-orange-700') }} w-fit rounded-md p-2 text-xs uppercase tracking-wider">
                            {{ $user->role === 1 ? 'Pharmacist' : ($user->role === 2 ? 'Doctor' : 'Administrator') }}
                        </div>
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-bold">

                        <form action="{{ route('users_status_change') }}" method="POST">
                            @csrf
                            <input type="hidden" name="uid" value="{{ $user->uid }}">
                            <input type="hidden" name="status" value="{{ $user->status }}">

                            <button type="submit"
                                class="{{ $user->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }} w-fit cursor-pointer rounded-md p-2 text-xs uppercase tracking-wider">
                                {{ $user->status }}
                            </button>

                        </form>
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $user->created_at->format('d-m-Y h:i A') }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('users_edit', $user->uid) }}"
                                class="cursor-pointer rounded-sm bg-sky-400 p-1 text-white hover:opacity-90">
                                <x-heroicon-o-pencil-square class="h-4 w-4" />
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $users->onEachSide(1)->links() }}
