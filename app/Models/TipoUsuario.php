<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $fillable = ['cargo'];
    protected $primaryKey = 'idtipousuario';
    use HasFactory;
}
