<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NyewaModel extends Model
{
    use HasFactory;
    protected $table = 'penyewaan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'penyewaan_id',
        'user_id',
        'created_at',
        'status',
        'img'
    ];

    public function penyewaan()
    {
        return $this->hasMany(PenyewaanModel::class,'id');
    }
}
