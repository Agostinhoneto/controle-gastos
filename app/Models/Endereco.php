<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'endereco', 'numero', 'complemento', 'bairro', 'cidade','estado', 'cep'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
