@extends('admin.layout.sidebar')
@section('title', 'Tickets')
@section('heading', 'Event Ticket Management')

@section('topbar-actions')
  <a href="{{ route('admin.ticket.create_ticket') }}"
    style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;border:none">
    + Add Ticket
  </a>
@endsection

@section('content')

  {{-- Stats --}}
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
    @foreach([
      ['Total Tickets', $stats['total'],                                          'All',     '#7c6ff7'],
      ['Sold',          number_format($stats['terjual']) . ' tickets',            'Tickets',   '#34d399'],
      ['Remaining',     number_format($stats['tersisa']) . ' tickets',            'Tickets',   '#fbbf24'],
      ['Revenue',       'Rp ' . number_format($stats['pendapatan'], 0, ',', '.'), 'Total',   '#7c6ff7'],
    ] as [$lbl, $val, $note, $color])
    <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:16px">
      <p style="font-size:11px;color:#6b7280;margin-bottom:4px">{{ $lbl }}</p>
      <p style="font-size:20px;font-weight:600;color:#fff">{{ $val }}</p>
      <span style="font-size:11px;padding:2px 8px;border-radius:99px;margin-top:6px;display:inline-block;background:rgba({{ $color === '#7c6ff7' ? '124,111,247' : ($color === '#34d399' ? '52,211,153' : '251,191,36') }},.15);color:{{ $color }}">{{ $note }}</span>
    </div>
    @endforeach
  </div>

  {{-- Table --}}
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;overflow:hidden">
    <div style="padding:14px 20px;border-bottom:1px solid #2a2d3e">
      <h2 style="font-weight:600;color:#fff;font-size:14px">Ticket List ({{ $tiket->count() }})</h2>
    </div>
    <div style="overflow-x:auto">
      <table style="width:100%;border-collapse:collapse;font-size:13px">
        <thead style="background:#13151f">
          <tr>
            @foreach(['Ticket Name','Event','Date','Price','Quota','Sold','Remaining','Status','Action'] as $h)
            <th style="text-align:{{ in_array($h,['Price','Quota','Sold','Remaining','Status','Action']) ? 'center' : 'left' }};padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase;letter-spacing:.05em">{{ $h }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @forelse($tiket as $t)
          <tr style="border-top:1px solid #2a2d3e" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
           <td style="padding:12px 16px;color:#e2e8f0;font-weight:500">{{ $t->nama_tiket }}</td>
            <td style="padding:12px 16px;color:#6b7280;max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $t->event?->nama ?? '—' }}</td>
            <td style="padding:12px 16px;color:#6b7280;white-space:nowrap">{{ $t->event?->tanggal?->format('d M Y') ?? '—' }}</td>
            <td style="padding:12px 16px;color:#e2e8f0;text-align:right;white-space:nowrap">Rp {{ number_format($t->harga, 0, ',', '.') }}</td>
            <td style="padding:12px 16px;color:#e2e8f0;text-align:center">{{ $t->kuota }}</td>
            <td style="padding:12px 16px;color:#e2e8f0;text-align:center">{{ $t->terjual }}</td>
            <td style="padding:12px 16px;color:#e2e8f0;text-align:center">{{ $t->sisa }}</td>
            <td style="padding:12px 16px;text-align:center">
              @php
                [$bg,$color,$label] = match($t->status) {
                  'Aktif'        => ['rgba(52,211,153,.15)','#34d399','Active'],
                  'Hampir Habis' => ['rgba(251,191,36,.15)','#fbbf24','Almost Full'],
                  'Habis'        => ['rgba(248,113,113,.15)','#f87171','Sold Out'],
                  default        => ['rgba(107,114,128,.15)','#6b7280','Draft'],
                };
              @endphp
              <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:{{ $bg }};color:{{ $color }}">{{ $label }}</span>
            </td>
            <td style="padding:12px 16px;text-align:center">
              <div style="display:flex;justify-content:center;gap:8px">
                <a href="{{ route('admin.ticket.edit_ticket', $t) }}"
                  style="padding:5px 12px;border:1px solid #2a2d3e;border-radius:8px;color:#a78bfa;font-size:12px;text-decoration:none;background:transparent"
                  onmouseover="this.style.background='rgba(124,111,247,0.1)'" onmouseout="this.style.background='transparent'">Edit</a>
                <form action="{{ route('admin.ticket.destroy', $t) }}" method="POST" onsubmit="return confirm('Delete this ticket?')" style="margin:0">
                  @csrf @method('DELETE')
                  <button type="submit"
                    style="padding:5px 12px;border:1px solid #3d1f1f;border-radius:8px;color:#f87171;font-size:12px;background:transparent;cursor:pointer"
                    onmouseover="this.style.background='rgba(248,113,113,0.1)'" onmouseout="this.style.background='transparent'">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="9" style="text-align:center;padding:48px;color:#4b5563">No tickets found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
