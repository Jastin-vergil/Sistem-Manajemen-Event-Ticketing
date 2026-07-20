@extends('admin.layout.sidebar')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-100">Payment & Participant Data</h2>
        <p class="text-gray-400 text-sm">Manage and monitor all ticket payment transactions.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Total Transaksi</p>
            <p class="text-2xl font-bold text-white">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Pending</p>
            <p class="text-2xl font-bold text-yellow-400">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Approved</p>
            <p class="text-2xl font-bold text-green-400">{{ $stats['approved'] }}</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Rejected</p>
            <p class="text-2xl font-bold text-red-400">{{ $stats['rejected'] }}</p>
        </div>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.participants') }}" class="mb-4">
        <div class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email pembeli..."
                class="w-full md:w-80 px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.participants') }}" class="px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-700">
        <table class="w-full text-gray-200">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Nama Pembeli</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Event</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Tanggal Bayar</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($participants as $index => $p)
                    <tr class="border-t border-gray-700 hover:bg-gray-800/50">
                        <td class="px-4 py-3">{{ $participants->firstItem() + $index }}</td>
                        <td class="px-4 py-3">{{ $p->nama_pembeli ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $p->email ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $p->tiket->event->nama ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @php
                                $badgeColor = match($p->status) {
                                    'Pending' => 'bg-yellow-500/20 text-yellow-400',
                                    'Approved', 'Verified' => 'bg-green-500/20 text-green-400',
                                    'Rejected' => 'bg-red-500/20 text-red-400',
                                    default => 'bg-gray-500/20 text-gray-400',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $badgeColor }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.pembayaran.show', $p->id) }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-400">
                            {{ request('search') ? 'No data matches the search.' : 'No payment data available yet.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $participants->links() }}
    </div>

</div>
@endsection
