<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventosFinanceiro extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'data_inicio', 'tipo', 'valor','categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }

}
