<div class="w-full px-2">
    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">general</span>
</div>

<x-dashboard.nav-link href="/" :active="request()->is('/')">
    <x-heroicon-o-home class="h-5 w-5" />
    <span class="text-sm font-medium">Dashboard</span>
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('patient') }}" :active="request()->is('patient*')">
    <x-heroicon-o-user-group class="h-5 w-5" />
    <span class="text-sm font-medium">Patient</span>
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('examination') }}" :active="request()->is('examination')">
    <x-heroicon-o-document-text class="h-5 w-5" />
    <span class="text-sm font-medium">Examination</span>
</x-dashboard.nav-link>

<x-dashboard.nav-link href="/" :active="request()->is('prescription')">
    <x-heroicon-o-eye-dropper class="h-5 w-5" />
    <span class="text-sm font-medium">Prescription</span>
</x-dashboard.nav-link>

<div class="w-full px-2">
    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">management</span>
</div>

<x-dashboard.nav-link href="/" :active="request()->is('/examination')">
    <x-heroicon-o-users class="h-5 w-5" />
    <span class="text-sm font-medium">Users</span>
</x-dashboard.nav-link>

<x-dashboard.nav-link href="/" :active="request()->is('/examination')">
    <x-heroicon-o-document-magnifying-glass class="h-5 w-5" />
    <span class="text-sm font-medium">Audit Log</span>
</x-dashboard.nav-link>
