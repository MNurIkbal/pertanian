<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranModel extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_id ',
        'nominal',
        'img',
        'created_at',
        'nyewa_id',
        'pesan'
    ];
}
