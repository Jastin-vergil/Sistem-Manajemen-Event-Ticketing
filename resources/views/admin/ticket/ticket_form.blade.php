<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Ticket Name <span style="color:#f87171">*</span></label>
    <input type="text" name="nama_tiket"
      value="{{ old('nama_tiket', $tiket->nama_tiket ?? '') }}"
      placeholder="e.g. VIP, Regular, Early Bird"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
    @error('nama_tiket')<p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>@enderror
  </div>

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Event <span style="color:#f87171">*</span></label>
    <select name="event_id"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
      <option value="">Select event...</option>
      @foreach($events as $ev)
        <option value="{{ $ev->id_event }}" {{ old('event_id', $tiket->event_id ?? '') == $ev->id_event ? 'selected' : '' }}>{{ $ev->nama }}</option>
      @endforeach
    </select>
    @error('event_id')<p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>@enderror
  </div>

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Price (Rp) <span style="color:#f87171">*</span></label>
    <input type="number" name="harga" min="0"
      value="{{ old('harga', $tiket->harga ?? 0) }}"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
    @error('harga')<p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>@enderror
  </div>

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Quota <span style="color:#f87171">*</span></label>
    <input type="number" name="kuota" min="1"
      value="{{ old('kuota', $tiket->kuota ?? '') }}"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
    @error('kuota')<p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>@enderror
  </div>

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Sale Start Date</label>
    <input type="date" name="tanggal_mulai"
      value="{{ old('tanggal_mulai', isset($tiket->tanggal_mulai) ? $tiket->tanggal_mulai->format('Y-m-d') : '') }}"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
  </div>

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Sale End Date</label>
    <input type="date" name="tanggal_akhir"
      value="{{ old('tanggal_akhir', isset($tiket->tanggal_akhir) ? $tiket->tanggal_akhir->format('Y-m-d') : '') }}"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
  </div>

  <div>
    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Status</label>
    <select name="status"
      style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
      <option value="Aktif"        {{ old('status', $tiket->status ?? 'Aktif') === 'Aktif'        ? 'selected' : '' }}>Active</option>
      <option value="Draft"        {{ old('status', $tiket->status ?? 'Aktif') === 'Draft'        ? 'selected' : '' }}>Draft</option>
    </select>
  </div>

</div>
