@extends('admin.layout.sidebar')

@section('content')
    <div class="container">
        <h2>Peserta Event: {{ $event->nama }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($participants as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->user->name ?? '-' }}</td>
                        <td>{{ $p->user->email ?? '-' }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada peserta</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
