<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $fillable  = [
        'user_leader_id',
        'user_anggota_id',
        'jenis_pekerjaan',
        'deskripsi',
        'file'
    ];
    protected $table = 'pekerjaan';

    public function leader()
    {
        return $this->belongsTo(User::class, 'user_leader_id', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(User::class, 'user_anggota_id', 'id');
    }
}
