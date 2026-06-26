@extends('admin.layout.sidebar')
@section('title', 'Payments')
@section('heading', 'Payment Verification')

@section('content')

  {{-- Stats --}}
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
    @foreach([
      ['Total',    $stats['total'],    'All',      'rgba(124,111,247,.15)', '#a78bfa'],
      ['Pending',  $stats['pending'],  'Waiting',  'rgba(251,191,36,.15)',  '#fbbf24'],
      ['Approved', $stats['approved'], 'Verified', 'rgba(52,211,153,.15)',  '#34d399'],
      ['Rejected', $stats['rejected'], 'Declined', 'rgba(248,113,113,.15)', '#f87171'],
    ] as [$lbl, $val, $note, $bg, $color])
    <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:16px">
      <p style="font-size:11px;color:#6b7280;margin-bottom:4px">{{ $lbl }}</p>
      <p style="font-size:22px;font-weight:600;color:#fff">{{ $val }}</p>
      <span style="font-size:11px;padding:2px 8px;border-radius:99px;margin-top:6px;display:inline-block;background:{{ $bg }};color:{{ $color }}">{{ $note }}</span>
    </div>
    @endforeach
  </div>

  {{-- Filter --}}
  <form method="GET" action="{{ route('admin.pembayaran.index') }}"
    style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:16px;display:flex;gap:12px;align-items:center">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..."
      style="flex:1;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none">
    <select name="status"
      style="background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none">
      <option value="">All Status</option>
      <option value="Pending"  {{ request('status') === 'Pending'  ? 'selected' : '' }}>Pending</option>
      <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
      <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
    <button type="submit"
      style="padding:8px 20px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border:none;border-radius:8px;font-size:13px;cursor:pointer">
      Filter
    </button>
    <a href="{{ route('admin.pembayaran.index') }}"
      style="padding:8px 16px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;text-decoration:none;font-size:13px">
      Reset
    </a>
  </form>

  {{-- Table --}}
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;overflow:hidden">
    <div style="padding:14px 20px;border-bottom:1px solid #2a2d3e">
      <h2 style="font-weight:600;color:#fff;font-size:14px">Payment List ({{ $pembayaran->count() }})</h2>
    </div>
    <table style="width:100%;border-collapse:collapse;font-size:13px">
      <thead style="background:#13151f">
        <tr>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Participant</th>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Ticket</th>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Event</th>
          <th style="text-align:right;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Total</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Proof</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Status</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pembayaran as $p)
        <tr style="border-top:1px solid #2a2d3e" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
          <td style="padding:12px 16px">
            <p style="color:#e2e8f0;font-weight:500;margin:0">{{ $p->nama_peserta }}</p>
            <p style="color:#6b7280;font-size:11px;margin:2px 0 0">{{ $p->email }}</p>
          </td>
          <td style="padding:12px 16px;color:#a78bfa">
              {{ $p->tiket?->nama_tiket ?? 'Tiket Tidak Ditemukan' }}
          </td>

          <td style="padding:12px 16px;color:#6b7280;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
              {{ $p->tiket?->event?->nama ?? 'Event Tidak Ditemukan' }}
          </td>
          <td style="padding:12px 16px;text-align:right;color:#e2e8f0;white-space:nowrap">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
          <td style="padding:12px 16px;text-align:center">
            @if($p->bukti_transfer)
              <a href="javascript:void(0)" 
               onclick="showProof('{{ asset('uploads/proofs/' . $p->bukti_transfer) }}')"
               style="font-size:11px;padding:3px 10px;border-radius:99px;background:rgba(52,211,153,.15);color:#34d399;text-decoration:none;cursor:pointer">View</a>
            @else
              <span style="color:#374151;font-size:12px">—</span>
            @endif
          </td>
          <td style="padding:12px 16px;text-align:center">
            @php
              [$bg,$color] = match($p->status) {
                'Approved' => ['rgba(52,211,153,.15)','#34d399'],
                'Rejected' => ['rgba(248,113,113,.15)','#f87171'],
                default    => ['rgba(251,191,36,.15)','#fbbf24'],
              };
            @endphp
            <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:{{ $bg }};color:{{ $color }}">{{ $p->status }}</span>
          </td>
          <td style="padding:12px 16px;text-align:center">
            <div style="display:flex;justify-content:center;gap:6px;flex-wrap:wrap">
              <a href="{{ route('admin.pembayaran.show', $p) }}"
                style="padding:5px 10px;border:1px solid #2a2d3e;border-radius:8px;color:#a78bfa;font-size:12px;text-decoration:none"
                onmouseover="this.style.background='rgba(124,111,247,0.1)'" onmouseout="this.style.background='transparent'">Detail</a>

              @if($p->status === 'Pending')
              <form action="{{ route('admin.pembayaran.approve', $p) }}" method="POST" style="margin:0">
                @csrf
                <button type="submit"
                  style="padding:5px 10px;border:1px solid #1a3d2e;border-radius:8px;color:#34d399;font-size:12px;background:transparent;cursor:pointer"
                  onmouseover="this.style.background='rgba(52,211,153,0.1)'" onmouseout="this.style.background='transparent'">Approve</button>
              </form>
              <button onclick="openReject({{ $p->id }})"
                style="padding:5px 10px;border:1px solid #3d1f1f;border-radius:8px;color:#f87171;font-size:12px;background:transparent;cursor:pointer"
                onmouseover="this.style.background='rgba(248,113,113,0.1)'" onmouseout="this.style.background='transparent'">Reject</button>
              @endif

              <form action="{{ route('admin.pembayaran.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete this record?')" style="margin:0">
                @csrf @method('DELETE')
                <button type="submit"
                  style="padding:5px 10px;border:1px solid #3d1f1f;border-radius:8px;color:#f87171;font-size:12px;background:transparent;cursor:pointer"
                  onmouseover="this.style.background='rgba(248,113,113,0.1)'" onmouseout="this.style.background='transparent'">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:48px;color:#4b5563">No payment records found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

{{-- Modal Proof --}}
<div id="modal-proof" onclick="closeProof()" 
  style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);z-index:60;align-items:center;justify-content:center">
  <div onclick="event.stopPropagation()" 
    style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px;max-width:520px;width:90%">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
      <h3 style="font-weight:600;color:#fff;font-size:14px;margin:0">Transfer Proof</h3>
      <button onclick="closeProof()" 
        style="background:transparent;border:none;color:#6b7280;font-size:22px;cursor:pointer;line-height:1">&times;</button>
    </div>
    <img id="proof-img" src="" alt="Transfer Proof" 
      style="width:100%;border-radius:8px;border:1px solid #2a2d3e;max-height:480px;object-fit:contain">
    <a id="proof-link" href="" target="_blank"
      style="display:inline-block;margin-top:12px;padding:8px 16px;border:1px solid #2a2d3e;border-radius:8px;color:#a78bfa;text-decoration:none;font-size:13px">
      🔗 Open Full Image
    </a>
  </div>
</div>

{{-- Modal Reject --}}
<div id="modal-reject" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:50;align-items:center;justify-content:center">
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px;width:420px">
    <h3 style="font-weight:600;color:#fff;font-size:14px;margin-bottom:16px">Reject Payment</h3>
    <form id="form-reject" method="POST">
      @csrf
      <div style="margin-bottom:16px">
        <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Reason (optional)</label>
        <textarea name="catatan" rows="3" required placeholder="e.g. Blurry proof, wrong amount..."
          style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box;resize:none"></textarea>
      </div>
      <div style="display:flex;gap:12px">
        <button type="submit"
          style="padding:9px 20px;background:#7f1d1d;color:#f87171;border:1px solid #991b1b;border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
          Confirm Reject
        </button>
        <button type="button" onclick="closeReject()"
          style="padding:9px 20px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;background:transparent;font-size:13px;cursor:pointer">
          Cancel
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function showProof(url) {
  document.getElementById('proof-img').src = url;
  document.getElementById('proof-link').href = url;
  document.getElementById('modal-proof').style.display = 'flex';
}
function closeProof() {
  document.getElementById('modal-proof').style.display = 'none';
  document.getElementById('proof-img').src = '';
}

function openReject(id) {
  document.getElementById('form-reject').action = '/pembayaran/' + id + '/reject';
  document.getElementById('modal-reject').style.display = 'flex';
  document.querySelector('[name="catatan"]').value = '';
}
function closeReject() {
  document.getElementById('modal-reject').style.display = 'none';
}

document.getElementById('modal-reject').addEventListener('click', function(e) {
  if (e.target === this) closeReject();
});

document.getElementById('form-reject').addEventListener('submit', function(e) {
  const field = document.querySelector('[name="catatan"]');
  if (!field.value.trim()) {
    e.preventDefault();
    field.style.borderColor = '#f87171';
    field.focus();
  }
});
</script>

@endsection
