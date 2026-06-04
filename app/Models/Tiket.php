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
}
