<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Event extends Model
    {
        public $timestamps = false;
        protected $table = 'events';

        protected $fillable = [
            'admin_id',
            'nama',
            'kategori_id',
            'tanggal',
            'jam_mulai',
            'jam_selesai',
            'lokasi',
            'deskripsi',
            'foto',
        ];

        protected $casts = [
            'tanggal' => 'datetime',
        ];

      public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function tiket(): HasMany
    {
        return $this->hasMany(Tiket::class, 'event_id', 'id');
    }
}
