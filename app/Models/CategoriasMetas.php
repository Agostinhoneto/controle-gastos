<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriasMetas extends Model
{
    use HasFactory;

    protected $fillable = ['categorias_id', 'meta_valor', 'start_date', 'end_date'];

    public function categorias()
    {
        return $this->hasMany(CategoriasMetas::class, 'categorias_id');
    }
}
