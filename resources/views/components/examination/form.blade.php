@props(['patients', 'medicines'])

<div class="h-full w-full overflow-y-auto px-5 py-5">

    <form action="{{ route('create_new_exam') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="h-full w-[500px]">

            <div class="py-1">
                <label for="full_name" class="text-xs uppercase tracking-wider">Patient</label>
                <select name="patient"
                    class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]">
                    <option selected disabled>Select patient here...</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->patient_code }}">
                            {{ $patient->patient_code . ' | ' . $patient->fullname . ' | ' . $patient->phone_number }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="py-1">
                <label for="full_name" class="text-xs uppercase tracking-wider">Vital Sign</label>
                <div class="h-fit w-full rounded-md bg-gray-100 p-3">

                    <div class="grid h-fit w-full grid-cols-4 gap-2">

                        <input type="number" name="height"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="height (cm)">

                        <input type="number" name="weight"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="weight (kg)">

                        <input type="number" name="systole"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="systole">

                        <input type="number" name="diastole"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="diastole">

                        <input type="number" name="heart_rate"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="heart rate">

                        <input type="number" name="respiration_rate"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="respiration rate">

                        <input type="number" name="body_temp"
                            class="my-1 w-28 rounded-md bg-white px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                            placeholder="body temp">

                    </div>
                </div>
            </div>

            <div class="py-1">
                <label for="full_name" class="text-xs uppercase tracking-wider">Doctor Notes</label>

                <textarea name="doctor_notes" cols="30" rows="8"
                    class="my-1 w-full resize-none rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                    placeholder="Doctor Notes"></textarea>
            </div>

            <div class="py-1">
                <label for="attachments" class="text-xs uppercase tracking-wider">Attachments</label>
                <input type="file" name="attachments[]"
                    class="my-1 w-full rounded-md px-3 py-2 text-sm font-medium outline-0 ring-1 focus:ring-[var(--acsentColor)]"
                    placeholder="Select documents/photos here..." multiple>
            </div>

            <div class="py-1" x-data="{
                medicines: [],
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

                    <span class="text-xs font-medium uppercase tracking-wider">medicines</span>
                    <div class="h-fit w-full p-2">
                        <span x-show="medicines.length === 0" class="text-gray-500">-</span>

                        <template x-for="(medicine, index) in medicines" :key="index">
                            <div class="flex items-center justify-between py-1 text-xs">

                                <span x-text="medicine.name"></span>
                                <span> - </span>
                                <span x-text="medicine.qty + ' qty'"></span>

                                <!-- HIDDEN INPUTS (INI YANG DIKIRIM KE SERVER) -->
                                <input type="hidden" :name="`medicines[${index}][id]`" :value="medicine.id">
                                <input type="hidden" :name="`medicines[${index}][name]`" :value="medicine.name">
                                <input type="hidden" :name="`medicines[${index}][qty]`" :value="medicine.qty">

                                <button @click="medicines.splice(index, 1)"
                                    class="flex cursor-pointer items-center justify-center rounded-sm text-rose-400 hover:opacity-90">
                                    x
                                </button>
                            </div>
                        </template>

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

        <div class="py-1">
            <button type="submit"
                class="my-2 flex w-full cursor-pointer items-center justify-center gap-2 rounded-md bg-[var(--acsentColor)] px-4 py-2 text-center font-medium text-white hover:opacity-90">
                <x-heroicon-o-check-circle class="h-5 w-5" />
                Submit
            </button>
        </div>

</div>

</form>
</div>
