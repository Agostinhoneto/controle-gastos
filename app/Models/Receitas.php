<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receitas extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'valor', 'data_recebimento','status','receita_id'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }
}
