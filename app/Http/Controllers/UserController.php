<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorize(User::class);
    }

    public function index(): View
    {
        return view('management.user.index');
    }
}
