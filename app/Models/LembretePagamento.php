<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembretePagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'despesa_id',
        'categoria_id',
        'titulo',
        'valor',
        'descricao',
        'data_aviso',
        'data_notificacao',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function despesa()
    {
        return $this->belongsTo(Despesas::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }
}
