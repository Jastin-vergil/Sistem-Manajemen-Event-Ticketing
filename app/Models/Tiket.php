<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tiket extends Model
{
    protected $table = 'tiket';

        // Beritahu Laravel kalau tabel ini bisa dicari menggunakan string 'nama_tiket'
    protected $primaryKey = 'nama_tiket'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'event_id','nama_tiket','harga','kuota','terjual',
        'tanggal_mulai','tanggal_akhir','status','keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date',
        'harga'         => 'integer',
        'kuota'         => 'integer',
        'terjual'       => 'integer',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function getSisaAttribute(): int
    {
        return $this->kuota - $this->terjual;
    }
}
