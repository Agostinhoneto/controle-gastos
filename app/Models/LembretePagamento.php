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
        'titulo',
        'descricao',
        'data_aviso',
        'data_notificacao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function despesa()
    {
        return $this->belongsTo(Despesas::class);
    }
}
