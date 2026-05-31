@extends('admin.layout.sidebar')
@section('title', 'Add Event')
@section('heading', 'Add New Event')

@section('topbar-actions')
    <a href="{{ route('admin.event.index') }}"
        style="padding:8px 16px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;text-decoration:none;font-size:13px"
        onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
        ← Back
    </a>
@endsection

@section('content')
    <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px;max-width:560px">
        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:flex;flex-direction:column;gap:16px">

                <div>
                    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Event Name
                        <span style="color:#f87171">*</span></label>
                    <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Event name..."
                        style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
                    @error('nama')
                        <p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label
                        style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Category</label>
                    <select name="kategori_id"
                        style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
                        <option value="">Select category...</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}"
                                {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Date <span
                            style="color:#f87171">*</span></label>
                    <input type="date" name="tanggal" required value="{{ old('tanggal') }}"
                        style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
                    @error('tanggal')
                        <p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label
                        style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Location</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Venue / city..."
                        style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box">
                </div>

                <div>
                    <label
                        style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Description</label>
                    <textarea name="deskripsi" rows="3" placeholder="Brief event description..."
                        style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#e2e8f0;outline:none;box-sizing:border-box;resize:vertical">{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:500;color:#9ca3af;margin-bottom:5px">Event
                        Photo</label>
                    <input type="file" name="foto" accept="image/*"
                        style="width:100%;background:#13151f;border:1px solid #2a2d3e;border-radius:8px;padding:8px 12px;font-size:13px;color:#9ca3af;outline:none;box-sizing:border-box">
                    <p style="font-size:11px;color:#4b5563;margin-top:4px">Format: JPG, PNG, WEBP. Max 2MB.</p>
                    @error('foto')
                        <p style="color:#f87171;font-size:11px;margin-top:4px">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div style="display:flex;gap:12px;margin-top:24px;padding-top:20px;border-top:1px solid #2a2d3e">
                <button type="submit"
                    style="padding:10px 24px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
                    Save Event
                </button>
                <a href="{{ route('admin.event.index') }}"
                    style="padding:10px 24px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;text-decoration:none;font-size:13px">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
