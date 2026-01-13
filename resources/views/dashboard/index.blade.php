<x-dashboard.layout>

    <div class="flex h-full w-full flex-col gap-3 p-3">

        <div class="h-fit w-full rounded-md bg-white px-10 py-5">
            <h2 class="text-xl font-bold">
                Dashboard
            </h2>

            <div class="my-5 grid w-full grid-cols-5 gap-4">
                <div class="bg-linear-120 h-24 w-[200px] rounded-md from-[#00c1a6] to-[#0082ba] p-3">
                    <h3 class="font-medium text-white">Patiens</h3>
                    <div class="flex h-full w-full items-center justify-end text-white">
                        <span class="px-2 text-right text-3xl font-bold">{{ $data['total_patient'] }}</span>
                        <x-heroicon-o-user-group class="h-8 w-8" />
                    </div>
                </div>

                <div class="bg-linear-120 h-24 w-[200px] rounded-md from-[#00c1a6] to-[#0082ba] p-3">
                    <h3 class="font-medium text-white">Examinations</h3>
                    <div class="flex h-full w-full items-center justify-end text-white">
                        <span class="px-2 text-right text-3xl font-bold">{{ $data['total_examination'] }}</span>
                        <x-heroicon-o-document-text class="h-8 w-8" />
                    </div>
                </div>

                <div class="bg-linear-120 h-24 w-[200px] rounded-md from-[#00c1a6] to-[#0082ba] p-3">
                    <h3 class="font-medium text-white">Transactions</h3>
                    <div class="flex h-full w-full items-center justify-end text-white">
                        <span class="px-2 text-right text-3xl font-bold">{{ $data['total_transaction'] }}</span>
                        <x-heroicon-o-banknotes class="h-8 w-8" />
                    </div>
                </div>

                <div class="bg-linear-120 h-24 w-[200px] rounded-md from-[#00c1a6] to-[#0082ba] p-3">
                    <h3 class="font-medium text-white">TX Income</h3>
                    <div class="flex h-full w-full items-center justify-end text-white">
                        <span
                            class="px-2 text-right font-bold">{{ Number::currency($data['tx_income'], precision: 0) }}</span>
                        <x-heroicon-o-currency-dollar class="h-8 w-8" />
                    </div>
                </div>

                <div class="bg-linear-120 h-24 w-[200px] rounded-md from-[#00c1a6] to-[#0082ba] p-3">
                    <h3 class="font-medium text-white">Medicine Sold</h3>
                    <div class="flex h-full w-full items-center justify-end text-white">
                        <span class="px-2 text-right text-3xl font-bold">{{ $data['medicine_sold'] }}</span>
                        <x-heroicon-o-arrow-up-right class="h-8 w-8" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-dashboard.layout>
