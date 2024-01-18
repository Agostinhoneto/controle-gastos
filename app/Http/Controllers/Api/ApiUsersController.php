<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class ApiUsersController extends Controller
{
  
    public function index()
    {
        $surfista = User::paginate();
        return UserResource::collection($surfista);
    }
}
