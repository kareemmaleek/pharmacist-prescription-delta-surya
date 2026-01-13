@props(['exam'])

<div x-data="{
    pay_amount: '',
    grand_total: @js($exam->medicine_prescription_data['grand_total']),
    change: '',
    calculate(amount) {
        this.pay_amount = amount;

        const res = this.pay_amount - this.grand_total;
        if (res < 0) {
            this.change = 0;
        } else {
            this.change = res;
        }

    },
}" class="h-full w-full overflow-auto px-2 py-5 md:px-5 lg:w-[580px]">

    <form action="{{ route('create_new_transaction', $exam->examination_code) }}" method="POST">
        @csrf

        <div class="py-1">
            <label for="patient" class="text-xs uppercase tracking-wider">Patient</label>
            <input type="text" name=""
                value="{{ $exam->patient->patient_code . ' | ' . $exam->patient->fullname }}"
                class="my-1 w-full cursor-not-allowed rounded-md bg-gray-200 px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                disabled>
        </div>

        <div class="py-1">
            <label for="patient" class="text-xs uppercase tracking-wider">Prescripted Medicines</label>
            <div class="h-fit w-full rounded-md bg-gray-200 p-2">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="">
                            <th class="p-1 text-left text-xs font-bold uppercase">Name</th>
                            <th class="p-1 text-left text-xs font-bold uppercase">Unit Price</th>
                            <th class="p-1 text-center text-xs font-bold uppercase">Qty</th>
                            <th class="p-1 text-xs font-bold uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        @foreach ($exam->medicine_prescription_data['data'] as $medicine)
                            <tr>
                                <td class="p-1">{{ $medicine['name'] }}</td>
                                <td class="p-1">{{ Number::currency($medicine['unit_price'], precision: 0) }}</td>
                                <td class="p-1 text-center">{{ $medicine['qty'] }}</td>
                                <td class="p-1">{{ Number::currency($medicine['subtotal'], precision: 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <input type="hidden" name="payment_total" value="{{ $exam->medicine_prescription_data['grand_total'] }}">

        <div class="py-1">
            <label for="grand_total" class="text-xs uppercase tracking-wider">Total</label>
            <input type="text"
                value="{{ Number::currency($exam->medicine_prescription_data['grand_total'], precision: 0) }}"
                class="my-1 w-full cursor-not-allowed rounded-md bg-gray-200 px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                disabled>
        </div>

        <div class="py-1">
            <label for="payment_method" class="text-xs uppercase tracking-wider">payment method</label>

            <select name="payment_method"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]">
                <option disabled selected>Select Payment Method...</option>
                <option value="cash">CASH</option>
                <option value="kredit">CREDIT CARD</option>
                <option value="debit">DEBIT CARD</option>
            </select>
        </div>

        <div class="py-1">
            <label for="payment_amount" class="text-xs uppercase tracking-wider">payment amount</label>
            <input x-model="pay_amount" @input="calculate($event.target.value)" type="number" name="payment_amount"
                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                placeholder="Rp. xxxx">
        </div>

        <div class="flex h-fit w-full items-center justify-between gap-2 py-1">
            <div class="flex h-28 w-full flex-col items-center justify-center rounded-md bg-emerald-100 p-2">
                <div class="h-fit w-fit text-center text-lg font-bold uppercase tracking-wide text-emerald-700">
                    Pay Amount
                </div>
                <div x-text="'Rp.' + pay_amount"
                    class="flex h-full items-center text-center text-base font-bold uppercase tracking-wide text-emerald-700">

                </div>
            </div>

            <input type="hidden" name="payment_change" :value="change">

            <div class="flex h-28 w-full flex-col items-center justify-center rounded-md bg-cyan-100 p-2">
                <div class="h-fit w-fit text-center text-lg font-bold uppercase tracking-wide text-emerald-700">
                    Change
                </div>
                <div x-text="'Rp.' + change"
                    class="flex h-full items-center text-center text-base font-bold uppercase tracking-wide text-cyan-700">

                </div>
            </div>
        </div>

        <div class="py-1">
            <button type="submit"
                class="my-2 flex w-full cursor-pointer items-center justify-center gap-2 rounded-md bg-[var(--acsentColor)] px-4 py-2 text-center font-medium text-white hover:opacity-90">
                <x-heroicon-o-banknotes class="h-5 w-5" />
                Pay Now
            </button>
        </div>

    </form>

</div>
