@extends('admin.layout.sidebar')
@section('title', 'Events')
@section('heading', 'Event Management')

@section('topbar-actions')
  <a href="{{ route('admin.event.create') }}"
    style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500">
    + Add Event
  </a>
@endsection

@section('content')
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;overflow:hidden">
    <div style="padding:14px 20px;border-bottom:1px solid #2a2d3e">
      <h2 style="font-weight:600;color:#fff;font-size:14px">Event List ({{ $events->count() }})</h2>
    </div>
    <table style="width:100%;border-collapse:collapse;font-size:13px">
      <thead style="background:#13151f">
        <tr>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Photo</th>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Event Name</th>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Category</th>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Date</th>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Location</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Tickets</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($events as $ev)
        <tr style="border-top:1px solid #2a2d3e" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
          <td style="padding:12px 16px">
            @if($ev->foto)
              <img src="{{ asset('storage/' . $ev->foto) }}" alt="{{ $ev->nama }}"
                style="width:60px;height:44px;object-fit:cover;border-radius:8px;border:1px solid #2a2d3e">
            @else
              <div style="width:60px;height:44px;background:#13151f;border-radius:8px;border:1px solid #2a2d3e;display:flex;align-items:center;justify-content:center;font-size:11px;color:#4b5563">No photo</div>
            @endif
          </td>
          <td style="padding:12px 16px;color:#e2e8f0;font-weight:500">{{ $ev->nama }}</td>
          <td style="padding:12px 16px">
            @if($ev->kategori)
              <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:rgba(124,111,247,.15);color:#a78bfa">{{ $ev->kategori->nama }}</span>
            @else
              <span style="color:#374151">—</span>
            @endif
          </td>
          <td style="padding:12px 16px;color:#6b7280;white-space:nowrap">{{ \Carbon\Carbon::parse($ev->tanggal)->format('d M Y') }}</td>
          <td style="padding:12px 16px;color:#6b7280">{{ $ev->lokasi ?: '—' }}</td>
          <td style="padding:12px 16px;text-align:center">
            <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:rgba(124,111,247,.15);color:#a78bfa">{{ $ev->tiket_count }} tickets</span>
          </td>
          <td style="padding:12px 16px;text-align:center">
          <div style="display:flex;justify-content:center;gap:8px">
            
            <button onclick="openParticipants({{ $ev->id }}, '{{ addslashes($ev->nama) }}')"
              style="padding:5px 12px;border:1px solid #2a2d3e;border-radius:8px;color:#34d399;font-size:12px;background:transparent;cursor:pointer"
              onmouseover="this.style.background='rgba(52,211,153,0.1)'" onmouseout="this.style.background='transparent'">
              Participants
            </button>

            <a href="{{ route('admin.event.edit', $ev) }}"
              style="padding:5px 12px;border:1px solid #2a2d3e;border-radius:8px;color:#a78bfa;font-size:12px;text-decoration:none"
              onmouseover="this.style.background='rgba(124,111,247,0.1)'" onmouseout="this.style.background='transparent'">Edit</a>

            <form action="{{ route('admin.event.destroy', $ev) }}" method="POST" onsubmit="return confirm('Delete this event?')" style="margin:0">
              @csrf @method('DELETE')
              <button type="submit"
                style="padding:5px 12px;border:1px solid #3d1f1f;border-radius:8px;color:#f87171;font-size:12px;background:transparent;cursor:pointer"
                onmouseover="this.style.background='rgba(248,113,113,0.1)'" onmouseout="this.style.background='transparent'">Delete</button>
            </form>
            
          </div>
        </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:48px;color:#4b5563">No events found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

 {{-- MODAL PARTICIPANTS --}}
<div id="participantsModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(0,0,0,0.6);align-items:center;justify-content:center">
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:14px;width:90%;max-width:750px;max-height:80vh;display:flex;flex-direction:column">

    {{-- Header --}}
    <div style="padding:16px 20px;border-bottom:1px solid #2a2d3e;display:flex;justify-content:space-between;align-items:center;flex-shrink:0">
      <div>
        <h3 id="modalTitle" style="color:#fff;font-size:14px;font-weight:600;margin:0">Participants</h3>
        <p id="modalCount" style="color:#6b7280;font-size:12px;margin:2px 0 0"></p>
      </div>
      <button onclick="closeModal()" style="background:transparent;border:none;color:#6b7280;font-size:20px;cursor:pointer;line-height:1">✕</button>
    </div>

    {{-- Body --}}
    <div style="overflow-y:auto;padding:16px 20px;flex:1">

      {{-- Loading --}}
      <div id="modalLoading" style="text-align:center;padding:40px;color:#6b7280">
        <div style="font-size:13px">Loading...</div>
      </div>

      {{-- Table --}}
      <table id="modalTable" style="display:none;width:100%;border-collapse:collapse;font-size:13px">
        <thead style="background:#13151f;position:sticky;top:0">
          <tr>
            <th style="text-align:left;padding:10px 12px;color:#4b5563;font-size:11px;text-transform:uppercase;font-weight:500">No</th>
            <th style="text-align:left;padding:10px 12px;color:#4b5563;font-size:11px;text-transform:uppercase;font-weight:500">Nama</th>
            <th style="text-align:left;padding:10px 12px;color:#4b5563;font-size:11px;text-transform:uppercase;font-weight:500">Email</th>
            <th style="text-align:left;padding:10px 12px;color:#4b5563;font-size:11px;text-transform:uppercase;font-weight:500">Tiket</th>
            <th style="text-align:left;padding:10px 12px;color:#4b5563;font-size:11px;text-transform:uppercase;font-weight:500">Total Bayar</th>
            <th style="text-align:center;padding:10px 12px;color:#4b5563;font-size:11px;text-transform:uppercase;font-weight:500">Status</th>
          </tr>
        </thead>
        <tbody id="modalBody"></tbody>
      </table>

      {{-- Empty --}}
      <div id="modalEmpty" style="display:none;text-align:center;padding:40px;color:#4b5563;font-size:13px">
        Belum ada peserta yang dikonfirmasi.
      </div>

    </div>
  </div>
</div>

<script>
function openParticipants(eventId, eventName) {
  const modal = document.getElementById('participantsModal');
  modal.style.display = 'flex';
  document.getElementById('modalTitle').textContent = eventName;
  document.getElementById('modalCount').textContent = '';
  document.getElementById('modalLoading').style.display = 'block';
  document.getElementById('modalTable').style.display = 'none';
  document.getElementById('modalEmpty').style.display = 'none';

  fetch(`/admin/event/${eventId}/participants`, {
    headers: { 'Accept': 'application/json' }
  })
  .then(r => r.json())
  .then(data => {
    document.getElementById('modalLoading').style.display = 'none';

    if (!data.participants.length) {
      document.getElementById('modalEmpty').style.display = 'block';
      return;
    }

    document.getElementById('modalCount').textContent = data.participants.length + ' peserta terkonfirmasi';

    document.getElementById('modalBody').innerHTML = data.participants.map((p, i) => `
      <tr style="border-top:1px solid #2a2d3e"
          onmouseover="this.style.background='rgba(255,255,255,0.02)'"
          onmouseout="this.style.background='transparent'">
        <td style="padding:11px 12px;color:#6b7280">${i + 1}</td>
        <td style="padding:11px 12px;color:#e2e8f0;font-weight:500">${p.nama}</td>
        <td style="padding:11px 12px;color:#6b7280">${p.email}</td>
        <td style="padding:11px 12px">
          <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:rgba(124,111,247,.15);color:#a78bfa">
            ${p.tiket}
          </span>
        </td>
        <td style="padding:11px 12px;color:#34d399;font-weight:500">${p.total_bayar}</td>
        <td style="padding:11px 12px;text-align:center">
          <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:rgba(52,211,153,.15);color:#34d399">
            Lunas
          </span>
        </td>
      </tr>
    `).join('');

    document.getElementById('modalTable').style.display = 'table';
  })
  .catch(() => {
    document.getElementById('modalLoading').innerHTML = '<div style="color:#f87171;font-size:13px">Gagal memuat data.</div>';
  });
}

function closeModal() {
  document.getElementById('participantsModal').style.display = 'none';
}

document.getElementById('participantsModal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
</script>
@endsection
