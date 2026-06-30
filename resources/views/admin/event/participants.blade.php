@extends('admin.layout.sidebar')

@section('content')
    <div class="container">
        <h2>Participants for Event: {{ $event->nama }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Registration Date</th>
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
                        <td colspan="5" class="text-center">No participants found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
