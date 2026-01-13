@props(['logs'])

<div class="relative my-3 w-full flex-1 overflow-auto rounded-lg border">
    <table class="w-full text-left text-sm">
        <thead class="text-body sticky top-0 z-10 border-b bg-green-50 text-sm">
            <tr>
                <th scope="col" class="px-6 py-2 font-medium">
                    Username
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Email
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    IP Address
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Module
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Description
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Created At
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr class="border-b bg-white hover:bg-green-100">
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $log->user->username }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $log->user->email }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $log->ip_address }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium uppercase">
                        {{ $log->module }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $log->description }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $log->created_at->format('d-m-Y h:i A') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $logs->onEachSide(1)->links() }}
