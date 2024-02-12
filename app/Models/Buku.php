<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "buku";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','judul','penulis','penerbit','tahun_terbit'
    ];

    public function kategoriRelasi() 
    {
        return $this->hasMany(KategoriRelasi::class);
    }
}
  