<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetasFinanceiras extends Model
{
    use HasFactory;

    protected $table = 'financas_metas';

    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'valor',
        'valor_corrente',
        'data_inicio',
        'data_fim',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
