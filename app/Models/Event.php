<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Event extends Model
    {
        // Pastikan nama tabel kamu sesuai (misal: 'events'){
        protected $table = 'events';

        protected $fillable = [
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

    /**
     * Relasi ke model Tiket (Satu event memiliki banyak tiket)
     */
    public function tikets(): HasMany
    {
        return $this->hasMany(Tiket::class, 'event_id', 'id');
    }

    /**
     * Custom Query untuk mengambil data pembayaran (peserta) pada event ini
     */
    public function pembayarans()
    {
        // Mencari ke tabel pembayaran berdasarkan string 'ticket_type' yang terdaftar di 'nama_tiket' milik event ini
        return Pembayaran::whereIn('ticket_type', $this->tikets()->pluck('nama_tiket'));
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
        // atau jika nama model-nya 'Ticket':
        // return $this->hasMany(Ticket::class);
    }
}