<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receitas extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id','descricao', 'valor', 'data_recebimento','status','comprovante_path','receita_id','usuario_cadastrante_id'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class,'categoria_id');
    }
}
