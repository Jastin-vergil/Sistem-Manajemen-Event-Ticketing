@extends('admin.layout.sidebar')
@section('title', 'Payment Detail')
@section('heading', 'Payment Detail')

@section('topbar-actions')
  <a href="{{ route('admin.pembayaran.index') }}"
    style="padding:8px 16px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;text-decoration:none;font-size:13px"
    onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
    ← Back
  </a>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start">

  {{-- Info --}}
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px">
    <h2 style="font-weight:600;color:#fff;font-size:14px;margin-bottom:20px">Payment Information</h2>

    @php
      [$bg,$color] = match($pembayaran->status) {
        'Approved' => ['rgba(52,211,153,.15)','#34d399'],
        'Rejected' => ['rgba(248,113,113,.15)','#f87171'],
        default    => ['rgba(251,191,36,.15)','#fbbf24'],
      };
    @endphp

    <div style="margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #2a2d3e">
      <span style="font-size:13px;font-weight:600;padding:6px 14px;border-radius:99px;background:{{ $bg }};color:{{ $color }}">
        {{ $pembayaran->status }}
      </span>
    </div>

    @foreach([
      ['Participant', $pembayaran->nama_peserta],
      ['Email',       $pembayaran->email],
      ['Ticket',      $pembayaran->tiket->nama_tiket],
      ['Event',       $pembayaran->tiket?->event?->nama ?? 'Event Tidak Ditemukan'],
      ['Total',       'Rp ' . number_format($pembayaran->total_bayar, 0, ',', '.')],
      ['Submitted',   $pembayaran->created_at->format('d M Y, H:i')],
    ] as [$lbl, $val])
    <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #2a2d3e">
      <span style="color:#6b7280;font-size:13px">{{ $lbl }}</span>
      <span style="color:#e2e8f0;font-size:13px;font-weight:500;text-align:right;max-width:200px">{{ $val }}</span>
    </div>
    @endforeach

    @if($pembayaran->catatan)
    <div style="margin-top:16px;padding:12px;background:#13151f;border-radius:8px;border:1px solid #3d1f1f">
      <p style="font-size:11px;color:#f87171;margin-bottom:4px;font-weight:500">Rejection Reason:</p>
      <p style="font-size:13px;color:#e2e8f0">{{ $pembayaran->catatan }}</p>
    </div>
    @endif

    @if($pembayaran->status === 'Pending')
    <div style="display:flex;gap:12px;margin-top:20px">
      <form action="{{ route('admin.pembayaran.approve', $pembayaran) }}" method="POST">
        @csrf
        <button type="submit"
          style="padding:10px 24px;background:rgba(52,211,153,.15);color:#34d399;border:1px solid rgba(52,211,153,.3);border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
          ✓ Approve
        </button>
      </form>
      <button onclick="openReject({{ $pembayaran->id }})"
        style="padding:10px 24px;background:rgba(248,113,113,.15);color:#f87171;border:1px solid rgba(248,113,113,.3);border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
        ✕ Reject
      </button>
    </div>
    @endif
  </div>

  {{-- Bukti Transfer --}}
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px">
    <h2 style="font-weight:600;color:#fff;font-size:14px;margin-bottom:16px">Transfer Proof</h2>
    @if($pembayaran->bukti_transfer)
      <img src="{{ asset('uploads/proofs/' . $pembayaran->bukti_transfer) }}" alt="Transfer Proof"
        style="width:100%;border-radius:8px;border:1px solid #2a2d3e">
      <a href="{{ asset('uploads/proofs/' . $pembayaran->bukti_transfer) }}" target="_blank"
        style="display:inline-block;margin-top:12px;padding:8px 16px;border:1px solid #2a2d3e;border-radius:8px;color:#a78bfa;text-decoration:none;font-size:13px">
        Open Full Image
      </a>
    @else
      <div style="width:100%;height:200px;background:#13151f;border-radius:8px;border:1px solid #2a2d3e;display:flex;align-items:center;justify-content:center;color:#4b5563;font-size:13px">
        No proof uploaded
      </div>
    @endif
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
        <textarea name="catatan" rows="3" placeholder="e.g. Blurry proof, wrong amount..."
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
function openReject(id) {
  document.getElementById('form-reject').action = '/pembayaran/' + id + '/reject';
  document.getElementById('modal-reject').style.display = 'flex';
}
function closeReject() {
  document.getElementById('modal-reject').style.display = 'none';
}
</script>

@endsection
