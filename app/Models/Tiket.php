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
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_akhir' => 'datetime',
        'harga' => 'integer',
        'kuota' => 'integer',
        'terjual' => 'integer',
    ];

    // TAMBAHKAN INI
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($tiket) {
            if ($tiket->tanggal_akhir && $tiket->tanggal_akhir->isPast()) {
                $tiket->delete();
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function getSisaAttribute(): int
    {
        return $this->kuota - $this->terjual;
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->harga, 0, ',', '.');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'tiket_id', 'id');
    }
}
