<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HistoricoFinanceiro extends Model
{
    protected $fillable = [
        'tipo', 'descricao', 'valor', 'data', 
        'categoria_id', 'user_id', 'comprovante_path'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getComprovanteUrlAttribute()
    {
        return $this->comprovante_path ? Storage::url($this->comprovante_path) : null;
    }
}