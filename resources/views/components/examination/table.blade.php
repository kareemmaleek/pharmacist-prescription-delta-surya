@props(['exam'])

<div class="relative my-3 w-full flex-1 overflow-auto rounded-lg border">
    <table class="w-full text-left text-sm">
        <thead class="text-body sticky top-0 z-10 border-b bg-green-50 text-sm">
            <tr>
                <th scope="col" class="px-6 py-2 font-medium">
                    Patient
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Doctor
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Vital Sign
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Doctor Notes
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Prescripted Medicine
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Status
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Attachments
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Created At
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Pharmacist
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Served At
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

            {{-- {{ dd($exam[0]->doctor->name) }} --}}

            @foreach ($exam as $examination)
                <tr class="border-b bg-white hover:bg-green-100">
                    <th scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $examination->patient->patient_code . ' | ' . $examination->patient->fullname }}
                    </th>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $examination->doctor->name }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">

                        <div class="flex h-fit w-fit gap-1">
                            <div class="flex w-[60px] flex-col text-[10px]">
                                <span>Weight : {{ $examination->weight }}</span>
                                <span>Height : {{ $examination->height }}</span>
                                <span>Systole : {{ $examination->systole }}</span>

                            </div>
                            <div class="flex w-[60px] flex-col text-[10px]">
                                <span>Diastole : {{ $examination->diastole }}</span>
                                <span>Heart Rate : {{ $examination->heart_rate }}</span>
                                <span>Respiration Rate : {{ $examination->respiration_rate }}</span>

                            </div>

                            <div class="flex w-[60px] flex-col text-[10px]">

                                <span>Body Temp : {{ $examination->body_temp }}</span>
                            </div>
                        </div>

                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div class="h-16 w-[200px] overflow-y-auto rounded-md bg-green-50 p-2">
                            {{ $examination->doctor_notes }}
                        </div>
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div
                            class="flex h-16 w-[300px] flex-col overflow-y-auto rounded-md bg-amber-50 p-2 text-[10px]">

                            @foreach ($examination->medicine_prescription_data['data'] as $medicine)
                                <span>{{ '- ' . $medicine['name'] . ' x' . $medicine['qty'] }}</span>
                            @endforeach

                        </div>
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div
                            class="{{ $examination->status == 'prescribed' ? 'bg-cyan-100 text-cyan-700' : 'bg-violet-100 text-violet-700' }} w-fit rounded-md p-2 text-xs uppercase tracking-wider">
                            {{ $examination->status }}
                        </div>

                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        <div class="flex h-fit w-fit items-center gap-2">

                            @foreach ($examination->examinationFiles as $file)
                                <div>
                                    <a href="{{ '/storage/' . $file->file_path }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-md border border-gray-400">
                                        <x-heroicon-o-document class="h-6 w-6" />
                                    </a>
                                </div>
                            @endforeach

                        </div>

                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $examination->created_at->format('d-m-Y h:i A') }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        {{ $examination->pharmacist->name ?? '-' }}
                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">
                        @if ($examination->served_at !== null)
                            {{ $examination->served_at->format('d-m-Y h:i A') }}
                        @else
                            -
                        @endif

                    </td>
                    <td scope="row" class="whitespace-nowrap px-6 py-2 font-medium">

                        <div class="flex items-center gap-2">

                            @if ($examination->status == 'prescribed')
                                <a href="{{ route('edit_exam', $examination->examination_code) }}"
                                    class="cursor-pointer rounded-sm bg-sky-400 p-1 text-white hover:opacity-90">
                                    <x-heroicon-o-pencil-square class="h-4 w-4" />
                                </a>

                                <a href="{{ route('new_transaction', $examination->examination_code) }}"
                                    class="cursor-pointer rounded-sm bg-emerald-400 p-1 text-white hover:opacity-90">
                                    <x-heroicon-o-document-currency-dollar class="h-4 w-4" />
                                </a>
                            @endif

                            <form action="{{ route('delete_exam', $examination->examination_code) }}" method="POST">
                                @csrf @method('DELETE')

                                <button type="submit"
                                    class="cursor-pointer rounded-sm bg-red-400 p-1 text-white hover:opacity-90">
                                    <x-heroicon-o-trash class="h-4 w-4" />
                                </button>

                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

{{ $exam->onEachSide(1)->links() }}
