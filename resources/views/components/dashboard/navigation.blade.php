<div class="hidden w-full px-2 lg:block">
    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">general</span>
</div>

<x-dashboard.nav-link href="/" :active="request()->is('/')">
    <x-heroicon-o-home class="h-5 w-5" />
    <span class="hidden text-sm font-medium lg:block">Dashboard</span>
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('patient') }}" :active="request()->is('patient*')">
    <x-heroicon-o-user-group class="h-5 w-5" />
    <span class="hidden text-sm font-medium lg:block">Patient</span>
</x-dashboard.nav-link>

<x-dashboard.nav-link href="{{ route('examination') }}" :active="request()->is('examination*')">
    <x-heroicon-o-document-text class="h-5 w-5" />
    <span class="hidden text-sm font-medium lg:block">Examination</span>
</x-dashboard.nav-link>

@if (auth()->user()->role == 0 || auth()->user()->role == 1)
    <x-dashboard.nav-link href="{{ route('transaction') }}" :active="request()->is('transaction*')">
        <x-heroicon-o-banknotes class="h-5 w-5" />
        <span class="hidden text-sm font-medium lg:block">Transactions</span>
    </x-dashboard.nav-link>
@endif

@if (auth()->user()->role == 0)
    <div class="w-full px-2">
        <span class="hidden text-[10px] font-bold uppercase tracking-wider text-gray-400 lg:block">management</span>
    </div>

    <x-dashboard.nav-link href="{{ route('users') }}" :active="request()->is('users*')">
        <x-heroicon-o-users class="h-5 w-5" />
        <span class="hidden text-sm font-medium lg:block">Users</span>
    </x-dashboard.nav-link>

    <x-dashboard.nav-link href="{{ route('audit_logs') }}" :active="request()->is('audit-logs*')">
        <x-heroicon-o-document-magnifying-glass class="h-5 w-5" />
        <span class="hidden text-sm font-medium lg:block">Audit Log</span>
    </x-dashboard.nav-link>
@endif
