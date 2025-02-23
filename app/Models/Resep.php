<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_masakan',
        'deskripsi',
        'foto_masakan',
        'kategori',
        'bahan',
        'cara_pengolahan',
        'foto_langkah',
        'link_youtube',
        'user_id', // Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


