@extends('admin.layout.sidebar')
@section('title', 'Add Ticket')
@section('heading', 'Add New Ticket')

@section('topbar-actions')
  <a href="{{ route('admin.ticket.interface') }}"
    style="padding:8px 16px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;text-decoration:none;font-size:13px"
    onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
    ← Back
  </a>
@endsection

@section('content')
  <div style="background:#1a1d2e;border:1px solid #2a2d3e;border-radius:12px;padding:24px;max-width:720px">
    <form action="{{ route('admin.ticket.store') }}" method="POST">
      @csrf
      @include('admin.ticket.ticket_form')
      <div style="display:flex;gap:12px;margin-top:24px;padding-top:20px;border-top:1px solid #2a2d3e">
        <button type="submit"
          style="padding:10px 24px;background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:500;cursor:pointer">
          Save Ticket
        </button>
        <a href="{{ route('admin.ticket.interface') }}"
          style="padding:10px 24px;border:1px solid #2a2d3e;border-radius:8px;color:#9ca3af;text-decoration:none;font-size:13px">
          Cancel
        </a>
      </div>
    </form>
  </div>
@endsection
