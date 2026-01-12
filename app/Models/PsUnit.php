<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsUnit extends Model
{
    protected $table = 'ps_units';
    protected $primaryKey = 'id_ps';
    //
    protected $fillable = [
    'nama_ps',
    'tipe_ps',
    'harga_per_jam',
    'status'
];

}
