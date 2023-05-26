<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanModel extends Model
{
    use HasFactory;
    protected $table = 'penyewaan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_penyedia',
        'nama_alat',
        'luas_tanah',
        'expired',
        'biaya',
        'pesan',
        'created_at',
        'img',
        'unit'
    ];

    public function alat()
    {
        return $this->belongsTo(AlatModel::class,'nama_alat');
    }
}
