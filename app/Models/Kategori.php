<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'admin_id'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'kategori_id');
    }
}
