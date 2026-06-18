<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .header { background: linear-gradient(135deg, #4f46e5, #7c3aed); padding: 30px; text-align: center; }
    .header h1 { color: #fff; margin: 0; font-size: 24px; }
    .header p { color: rgba(255,255,255,0.8); margin: 6px 0 0; font-size: 13px; }
    .ticket-box { margin: 24px; border: 2px dashed #4f46e5; border-radius: 12px; padding: 24px; background: #fafafa; }
    .ticket-code { text-align: center; margin-bottom: 20px; }
    .ticket-code span { font-size: 28px; font-weight: bold; color: #4f46e5; letter-spacing: 4px; }
    .ticket-code p { color: #888; font-size: 11px; margin: 4px 0 0; }
    .divider { border: none; border-top: 1px dashed #ddd; margin: 16px 0; }
    .info-row { display: flex; justify-content: space-between; margin: 10px 0; }
    .info-row .label { color: #888; font-size: 12px; }
    .info-row .value { color: #1a1a1a; font-size: 13px; font-weight: 600; text-align: right; max-width: 60%; }
    .status-badge { display: inline-block; background: #d1fae5; color: #065f46; padding: 4px 14px; border-radius: 99px; font-size: 12px; font-weight: 600; }
    .footer { background: #f8f8f8; padding: 20px; text-align: center; color: #aaa; font-size: 11px; border-top: 1px solid #eee; }
  </style>
</head>
<body>
  <div class="container">

    <div class="header">
      <h1>E-Ticket Kamu</h1>
      <p>Tunjukkan tiket ini saat masuk ke event</p>
    </div>

    <div class="ticket-box">

      <div class="ticket-code">
        <span>TXN-{{ str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT) }}</span>
        <p>Kode Tiket / Transaction ID</p>
      </div>

      <hr class="divider">

      <div class="info-row">
        <span class="label">Nama Peserta</span>
        <span class="value">{{ $pembayaran->nama_peserta }}</span>
      </div>
      <div class="info-row">
        <span class="label">Email</span>
        <span class="value">{{ $pembayaran->email }}</span>
      </div>
      <div class="info-row">
        <span class="label">Event</span>
        <span class="value">{{ $pembayaran->tiket->event->nama ?? '-' }}</span>
      </div>
      <div class="info-row">
        <span class="label">Jenis Tiket</span>
        <span class="value">{{ $pembayaran->tiket->nama_tiket ?? '-' }}</span>
      </div>
      <div class="info-row">
        <span class="label">Tanggal Event</span>
        <span class="value">
          {{ $pembayaran->tiket->event->tanggal
              ? \Carbon\Carbon::parse($pembayaran->tiket->event->tanggal)->format('d M Y')
              : '-' }}
        </span>
      </div>
      <div class="info-row">
        <span class="label">Lokasi</span>
        <span class="value">{{ $pembayaran->tiket->event->lokasi ?? '-' }}</span>
      </div>
      <div class="info-row">
        <span class="label">Total Bayar</span>
        <span class="value">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</span>
      </div>

      <hr class="divider">

      <div style="text-align:center;margin-top:12px">
        <span class="status-badge">Pembayaran Dikonfirmasi</span>
      </div>

    </div>

    <div class="footer">
      <p>Email ini dikirim otomatis oleh sistem Event Polibatam.</p>
      <p>Jangan balas email ini.</p>
    </div>

  </div>
</body>
</html>