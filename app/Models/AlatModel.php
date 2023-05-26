<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatModel extends Model
{
    use HasFactory;
    protected $table = 'alat';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'active',
        'created_at',
        'kode',
        'img'
    ];
}
