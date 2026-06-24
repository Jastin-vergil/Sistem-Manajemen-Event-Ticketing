<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tiket extends Model
{
    protected $table = 'tiket';

    protected $fillable = [
        'event_id',
        'nama_tiket',
        'harga',
        'kuota',
        'terjual',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_akhir' => 'datetime',
        'harga' => 'integer',
        'kuota' => 'integer',
        'terjual' => 'integer',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function getSisaAttribute(): int
    {
        return $this->kuota - $this->terjual;
    }

    // Helper: format harga ke Rupiah
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'tiket_id', 'id');
    }
    // App\Models\Tiket.php

    public function updateStatus(): void
    {
        $sisa = $this->kuota - $this->terjual;
        $persen = $this->kuota > 0 ? ($sisa / $this->kuota) * 100 : 0;

        $status = match (true) {
            $sisa <= 0 => 'Habis',
            $persen <= 10 => 'Hampir Habis',
            default => 'Aktif',
        };

        $this->update(['status' => $status]);
    }
}
