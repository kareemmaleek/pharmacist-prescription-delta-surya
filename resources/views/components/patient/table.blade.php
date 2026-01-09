@props(['patients'])

<div class="relative my-3 w-full flex-1 overflow-y-auto rounded-lg border">
    <table class="w-full text-left text-sm">
        <thead class="text-body sticky top-0 z-10 border-b bg-green-50 text-sm">
            <tr>
                <th scope="col" class="px-6 py-2 font-medium">
                    Patient Code
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Full Name
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Created at
                </th>
            </tr>
        </thead>
        <tbody>

            {{-- {{ dd($patients) }} --}}

            @foreach ($patients as $patient)
                <tr class="border-b bg-white hover:bg-green-100">
                    <th scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $patient->patient_code }}
                    </th>
                    <th scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $patient->fullname }}
                    </th>
                    <th scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $patient->phone_number }}
                    </th>
                    <th scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $patient->created_at }}
                    </th>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

{{ $patients->onEachSide(1)->links() }}
