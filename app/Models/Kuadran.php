<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuadran extends Model
{
    use HasFactory;

    protected $table = 'kuadran';
    protected $fillable = [
        'nip',
        'hasil_kerja',
        'perilaku_kerja',
        'hasil',
    ];
}