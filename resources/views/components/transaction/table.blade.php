@props(['transaction'])

{{-- {{ dd($transaction) }} --}}

<div class="relative my-3 w-full flex-1 overflow-auto rounded-lg border">
    <table class="w-full text-left text-sm">
        <thead class="text-body sticky top-0 z-10 border-b bg-green-50 text-sm">
            <tr>
                <th scope="col" class="px-6 py-2 font-medium">
                    TX Code
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Examination Code
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Patient
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Prescripted Medicines
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Payment Method
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Payment Total
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Payment Amount
                </th>

                <th scope="col" class="px-6 py-2 font-medium">
                    Payment Change
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Created At
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Status
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction as $item)
                <tr class="border-b bg-white hover:bg-green-100">
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $item->tx_code }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $item->examination->examination_code }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $item->examination->patient->patient_code . ' | ' . $item->examination->patient->fullname }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div
                            class="flex h-16 w-[300px] flex-col overflow-y-auto rounded-md bg-amber-50 p-2 text-[10px]">

                            @foreach ($item->examination->medicine_prescription_data['data'] as $medicine)
                                <span>{{ '- ' . $medicine['name'] . ' x' . $medicine['qty'] }}</span>
                            @endforeach

                        </div>
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium uppercase">
                        {{ $item->payment_method }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ Number::currency($item->payment_total, precision: 0) }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ Number::currency($item->payment_amount, precision: 0) }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ Number::currency($item->payment_change, precision: 0) }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $item->created_at->format('d-m-Y h:i A') }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div
                            class="{{ $item->status == 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} w-fit rounded-md p-2 text-xs uppercase tracking-wider">
                            {{ $item->status }}
                        </div>
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('create_receipt', $item->tx_code) }}"
                                class="cursor-pointer rounded-sm bg-amber-400 p-1 hover:opacity-90">
                                <x-heroicon-o-document-arrow-down class="h-5 w-5" />
                            </a>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $transaction->onEachSide(1)->links() }}
