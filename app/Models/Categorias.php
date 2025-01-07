<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $fillable = ['descricao'];

    public function despesas()
    {
        return $this->hasMany(Despesas::class,'categoria_id');
    }

    public function receitas()
    {
        return $this->hasMany(Receitas::class,'categoria_id');
    }

    public function categoriasmetas()
    {
        return $this->hasMany(CategoriasMetas::class,'categoria_id');
    }

    public function eventos()
    {
        return $this->hasMany(EventosFinanceiro::class);
    }
}
