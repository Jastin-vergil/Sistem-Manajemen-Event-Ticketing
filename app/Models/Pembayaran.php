<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    // Mengarahkan ke tabel manual phpMyAdmin kamu
    protected $table = 'pembayaran';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'nama_peserta',
        'email',
        'ticket_type',
        'price',
        'proof',
        'status'
    ];

    public function tiket()
{
    return $this->belongsTo(Tiket::class, 'ticket_type');
}
}

