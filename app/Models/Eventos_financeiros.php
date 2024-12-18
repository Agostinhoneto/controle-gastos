<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos_financeiros extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'data_inicio',
        'tipo',
        'valor'
    ];
}
