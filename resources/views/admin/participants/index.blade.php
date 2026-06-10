/* participants */
@extends('admin.layout.sidebar')

@section('content')

<div class="overflow-x-auto bg-white/5 border border-white/10 rounded-xl shadow-md">
    <table class="w-full text-left border-collapse text-sm text-gray-200">
        <thead class="bg-white/10 text-xs uppercase tracking-wider text-purple-400 border-b border-white/10">
            <tr>
                <th class="px-6 py-4 text-center">No</th>
                <th class="px-6 py-4">Nama Peserta</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Jenis Tiket</th>
                <th class="px-6 py-4">Total Bayar</th>
                <th class="px-6 py-4 text-center">Bukti</th>
                <th class="px-6 py-4 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($participants as $index => $p)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold text-white">{{ $p->nama_peserta }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ $p->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs rounded-md">
                            {{ ucwords(str_replace('_', ' ', $p->ticket_type)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-mono text-emerald-400">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($p->proof)
                            <a href="{{ asset('uploads/proofs/' . $p->proof) }}" target="_blank" class="inline-flex items-center text-xs text-purple-400 hover:underline">
                                👁️ View Image
                            </a>
                        @else
                            <span class="text-xs text-gray-500">No File</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2.5 py-1 bg-green-900/40 border border-green-500/40 text-green-400 text-xs font-semibold rounded-full shadow-sm">
                            {{ $p->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                        Belum ada data peserta yang dikonfirmasi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



@endsection