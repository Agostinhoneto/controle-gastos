<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'valor', 'data_pagamento','status','receita_id'];

    public function categoria()
    {
        return $this->hasMany(Categorias::class);
    }

}
