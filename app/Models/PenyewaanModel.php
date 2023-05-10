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
        'nama_nyewa',
        'jenis',
        'satuan',
        'expired',
        'biaya',
        'pesan',
        'created_at',
        'img',
        'unit'
    ];
}
