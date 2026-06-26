<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    // Mengarahkan ke tabel manual phpMyAdmin 
    protected $table = 'pembayaran';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'tiket_id',
        'nama_peserta',
        'email',
        'total_bayar',
        'bukti_transfer',
        'status',
        'catatan'
    ];

    public function tiket(): BelongsTo
    {
        return $this->belongsTo(Tiket::class, 'tiket_id', 'id');
    }
}

