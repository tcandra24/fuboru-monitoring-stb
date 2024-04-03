<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user_count = User::count();
        return Inertia::render('Dashboard/Index', [
            'user_count' => $user_count
        ]);
    }
}
