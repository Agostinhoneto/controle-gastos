<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetasCategorias extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id', 'meta_valor', 'start_date', 'end_date'];

    public function category()
    {
        return $this->belongsTo(Categorias::class);
    }
}
