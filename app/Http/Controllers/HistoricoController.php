<?php

namespace App\Http\Controllers;

use App\Models\FinancialGoal;
use Illuminate\Http\Request;

use App\Models\HistoricoFinanceiro;
use App\Models\Categorias;  
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class HistoricoController extends Controller
{
    public function index()
    {
        return view('historico.index');
    }

}