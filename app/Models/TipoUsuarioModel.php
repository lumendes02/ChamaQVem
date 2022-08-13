<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarioModel extends Model
{
    protected $fillable = ['cargo'];
    use HasFactory;
}
