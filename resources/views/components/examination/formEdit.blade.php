@props(['exam', 'medicines'])

<div class="h-full w-full overflow-y-auto px-5 py-5">

    <form action="{{ route('update_exam', $exam->examination_code) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="h-full w-[580px]">

            <div class="py-1">
                <label class="text-xs uppercase tracking-wider">Patient</label>
                <input type="text" value="{{ $exam->patient->patient_code . ' | ' . $exam->patient->fullname }}"
                    class="my-1 w-full cursor-not-allowed rounded-md bg-gray-200 px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                    disabled>
            </div>

            <div class="py-1">
                <label for="vital_sign" class="text-xs uppercase tracking-wider">Vital Sign</label>
                <div class="h-fit w-full rounded-md bg-gray-100 p-3">

                    <div class="grid h-fit w-full grid-cols-4 gap-2">

                        <div class="w-fit font-bold">
                            <label for="height" class="text-xs uppercase tracking-wider">Height</label>
                            <input type="number" name="height" value="{{ old('height', $exam->height) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="height (cm)">
                        </div>

                        <div class="w-fit font-bold">
                            <label for="weight" class="text-xs uppercase tracking-wider">Weight</label>
                            <input type="number" name="weight" value="{{ old('weight', $exam->weight) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="weight (kg)">
                        </div>

                        <div class="w-fit font-bold">
                            <label for="systole" class="text-xs uppercase tracking-wider">Systole</label>
                            <input type="number" name="systole" value="{{ old('systole', $exam->systole) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="systole">
                        </div>

                        <div class="w-fit font-bold">
                            <label for="diastole" class="text-xs uppercase tracking-wider">Diastole</label>
                            <input type="number" name="diastole" value="{{ old('diastole', $exam->diastole) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="diastole">
                        </div>

                        <div class="w-fit font-bold">
                            <label for="heart_rate" class="text-xs uppercase tracking-wider">Heart Rate</label>
                            <input type="number" name="heart_rate" value="{{ old('heart_rate', $exam->heart_rate) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="heart rate">
                        </div>

                        <div class="w-fit font-bold">
                            <label for="respiration_rate" class="text-xs uppercase tracking-wider">Respiration
                                Rate</label>
                            <input type="number" name="respiration_rate"
                                value="{{ old('respiration_rate', $exam->respiration_rate) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="respiration rate">
                        </div>

                        <div class="w-fit font-bold">
                            <label for="body_temp" class="text-xs uppercase tracking-wider">Body Temp</label>
                            <input type="number" name="body_temp" step=".1"
                                value="{{ old('body_temp', $exam->body_temp) }}"
                                class="my-1 w-32 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="body temp">
                        </div>

                    </div>
                </div>
            </div>

            <div class="py-1">
                <label for="full_name" class="text-xs uppercase tracking-wider">Doctor Notes</label>

                <textarea name="doctor_notes" cols="30" rows="8"
                    class="my-1 w-full resize-none rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                    placeholder="Doctor Notes">{{ old('doctor_notes', $exam->doctor_notes) }}</textarea>
            </div>

            {{-- {{ dd($exam->medicine_prescription) }} --}}

            <div class="py-1" x-data="{
                medicines: @js($exam->medicine_prescription_data['data']),
                availableMedicines: [],
                selectedMedicine: {
                    id: '',
                    name: '',
                    qty: ''
                },
                async getMedicines() {
                    const res = await fetch('/api/get-medicines');
                    this.availableMedicines = (await res.json()).medicines;
            
            
                },
            
            
            
            }" x-init="getMedicines()">
                <label for="full_name" class="text-xs uppercase tracking-wider">Medical prescription</label>
                <div class="h-fit w-full rounded-md bg-gray-100 p-3">

                    <div class="h-fit w-full p-2">
                        <table class="w-full table-auto text-sm">
                            <thead>
                                <tr class="">
                                    <th class="p-1 text-left text-xs font-bold uppercase">Name</th>
                                    <th class="p-1 text-center text-xs font-bold uppercase">Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr x-show="medicines.length === 0">
                                    <td colspan="3">
                                        <div class="text-center">No Data Selected</div>
                                    </td>
                                </tr>
                                <template x-for="(medicine, index) in medicines" :key="index">
                                    <tr>
                                        <td class="p-1">
                                            <span x-text="medicine.name"></span>
                                        </td>
                                        <td class="p-1 text-center">
                                            <span x-text="medicine.qty"></span>
                                        </td>
                                        <input type="hidden" :name="`medicines[${index}][id]`" :value="medicine.id">
                                        <input type="hidden" :name="`medicines[${index}][name]`"
                                            :value="medicine.name">
                                        <input type="hidden" :name="`medicines[${index}][qty]`"
                                            :value="medicine.qty">
                                        <td class="p-1">
                                            <button @click="medicines.splice(index, 1)"
                                                class="flex cursor-pointer items-center justify-center rounded-sm text-rose-400 hover:opacity-90">
                                                x
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>

                    </div>

                    <div class="flex w-full items-center gap-2">
                        <div class="w-full">
                            <select x-model="selectedMedicine.id"
                                @change="if($event.target.value) selectedMedicine.name = availableMedicines.find(m => m.id === $event.target.value)?.name || ''"
                                class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]">

                                <option selected disabled>Select medicine here...</option>
                                <template x-for="med in availableMedicines" :key="med.id">

                                    <option :value="med.id" x-text="med.name"></option>
                                </template>

                            </select>
                        </div>

                        <div class="w-20 py-2">
                            <input type="number" x-model.number="selectedMedicine.qty"
                                class="w-full rounded-md px-2 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                                placeholder="Qty">
                        </div>

                        <button
                            @click.prevent="
                if(selectedMedicine.id && selectedMedicine.qty >= 1) {
                    if(!medicines.find(m => m.id === selectedMedicine.id)) {
                        medicines.push({...selectedMedicine});
                        console.log(medicines);
                    }
                    selectedMedicine = {id: '', name: '', qty: 1};
                } else {
                    alert('Choose medicine and qty minimum is 1. !');
                }
            "
                            type="button"
                            class="flex w-16 cursor-pointer items-center justify-center rounded-md bg-blue-300 py-2 ring-1 hover:opacity-90">
                            <x-heroicon-o-plus class="h-5 w-5" />
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <div class="w-[580px] py-1">
            <button type="submit"
                class="my-2 flex w-full cursor-pointer items-center justify-center gap-2 rounded-md bg-[var(--acsentColor)] px-4 py-2 text-center font-medium text-white hover:opacity-90">
                <x-heroicon-o-check-circle class="h-5 w-5" />
                Submit
            </button>
        </div>

</div>

</form>
</div>
