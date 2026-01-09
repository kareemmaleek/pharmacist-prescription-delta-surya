@if ($message = Session::get('error'))
    <div
        id="toast-error"
        class="toast-ease fixed top-5 left-1/2 z-50 z-[99999] hidden -translate-x-1/2 rounded-md bg-black px-4 py-2 text-sm text-white shadow-lg"
    >
        <div class="flex w-full items-center gap-1">
            <x-heroicon-s-x-circle class="h-4 w-4 text-rose-400" />
            {{ $message }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div
        id="toast-error"
        class="fixed top-5 left-1/2 z-[99999] -translate-x-1/2 rounded-md bg-black px-4 py-2 text-sm text-white shadow-lg"
    >
        <div class="flex flex-col">
            @foreach ($errors->all() as $error)
                <span class="flex items-center gap-2">
                    <x-heroicon-s-x-circle class="h-4 w-4 text-rose-400" />
                    {{ $error }}
                </span>
            @endforeach
        </div>
    </div>
@endif

@if ($message = Session::get('success'))
    <div
        id="toast-success"
        class="toast-ease fixed top-5 left-1/2 z-50 z-[99999] hidden -translate-x-1/2 rounded-md bg-black px-4 py-2 text-sm text-white shadow-lg"
    >
        <div class="flex w-full items-center gap-1">
            <x-heroicon-s-check-circle class="h-4 w-4 text-emerald-400" />
            {{ $message }}
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        ['toast-error', 'toast-success'].forEach((id) => {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.remove('hidden');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 5000);
            }
        });
    });
</script>
