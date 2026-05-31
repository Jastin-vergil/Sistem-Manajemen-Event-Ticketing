@extends('admin.layout.app')
@section('title', 'Categories')
@section('heading', 'Category Management')

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start">

  {{-- Form Tambah --}}
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px">
    <h2 style="font-weight:600;color:#fff;font-size:14px;margin-bottom:16px">Add New Category</h2>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
      @csrf
      <div style="margin-bottom:12px">
        <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Category Name <span style="color:#f87171">*</span></label>
        <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="e.g. Music, Sports..."
          style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
        @error('nama')<p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>@enderror
      </div>
      <button type="submit"
        style="padding:9px 20px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
        Save Category
      </button>
    </form>
  </div>

  {{-- Tabel Kategori --}}
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;overflow:hidden">
    <div style="padding:14px 20px;border-bottom:1px solid #2a2d3e">
      <h2 style="font-weight:600;color:#fff;font-size:14px">Category List ({{ $kategori->count() }})</h2>
    </div>
    <table style="width:100%;border-collapse:collapse;font-size:13px">
      <thead style="background:#13151f">
        <tr>
          <th style="text-align:left;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Category Name</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Events</th>
          <th style="text-align:center;padding:10px 16px;font-size:11px;font-weight:500;color:#4b5563;text-transform:uppercase">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kategori as $kat)
        <tr style="border-top:1px solid #2a2d3e" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
          <td style="padding:12px 16px;color:#e2e8f0;font-weight:500">{{ $kat->nama }}</td>
          <td style="padding:12px 16px;text-align:center">
            <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:99px;background:rgba(124,111,247,.15);color:#a78bfa">{{ $kat->events_count }} events</span>
          </td>
          <td style="padding:12px 16px;text-align:center">
            <div style="display:flex;justify-content:center;gap:8px">
              <button onclick="openEdit({{ $kat->id }}, '{{ $kat->nama }}')"
                style="padding:5px 12px;border:1px solid #2a2d3e;border-radius:8px;color:#a78bfa;font-size:12px;background:transparent;cursor:pointer"
                onmouseover="this.style.background='rgba(124,111,247,0.1)'" onmouseout="this.style.background='transparent'">Edit</button>
              <form action="{{ route('admin.kategori.destroy', $kat) }}" method="POST" onsubmit="return confirm('Delete this category?')" style="margin:0">
                @csrf @method('DELETE')
                <button type="submit"
                  style="padding:5px 12px;border:1px solid #3d1f1f;border-radius:8px;color:#f87171;font-size:12px;background:transparent;cursor:pointer"
                  onmouseover="this.style.background='rgba(248,113,113,0.1)'" onmouseout="this.style.background='transparent'">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;padding:48px;color:#4b5563">No categories found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

{{-- Modal Edit --}}
<div id="modal-edit" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:50;align-items:center;justify-content:center">
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px;width:400px">
    <h3 style="font-weight:600;color:#fff;font-size:14px;margin-bottom:16px">Edit Category</h3>
    <form id="form-edit" method="POST">
      @csrf @method('PUT')
      <div style="margin-bottom:12px">
        <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Category Name <span style="color:#f87171">*</span></label>
        <input type="text" name="nama" id="edit-nama" required
          style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
      </div>
      <div style="display:flex;gap:12px;margin-top:20px">
        <button type="submit"
          style="padding:9px 20px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
          Update
        </button>
        <button type="button" onclick="closeEdit()"
          style="padding:9px 20px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;background:transparent;font-size:13px;cursor:pointer">
          Cancel
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function openEdit(id, nama) {
  document.getElementById('form-edit').action = '/kategori/' + id;
  document.getElementById('edit-nama').value = nama;
  document.getElementById('modal-edit').style.display = 'flex';
}
function closeEdit() {
  document.getElementById('modal-edit').style.display = 'none';
}
document.getElementById('modal-edit').addEventListener('click', function(e) {
  if (e.target === this) closeEdit();
});
</script>

@endsection
