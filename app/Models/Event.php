<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = ['nama', 'kategori_id', 'tanggal', 'lokasi', 'deskripsi', 'foto'];

    protected $casts = ['tanggal' => 'date'];

    public function tiket(): HasMany
    {
        return $this->hasMany(Tiket::class, 'event_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
