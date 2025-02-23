<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResep extends Model
{
    use HasFactory;

    protected $table = 'user_reseps'; // Nama tabel di database

    protected $fillable = [
        'user_id',
        'nama_masakan',
        'deskripsi',
        'foto_masakan',
        'kategori',
        'bahan',
        'cara_pengolahan',
        'foto_langkah',
        'link_youtube',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
