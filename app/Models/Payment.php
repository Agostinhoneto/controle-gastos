<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'quantia', 'datas', 'is_paid', 'user_id'];

    protected $dates = ['datas']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
