<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensagens extends Model
{
    use HasFactory;

    protected $primaryKey = 'idmensagem';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idusuario',
        'idloja',
        'titulo',
        'textomensagem',
        'idstatus'
    ];
}
