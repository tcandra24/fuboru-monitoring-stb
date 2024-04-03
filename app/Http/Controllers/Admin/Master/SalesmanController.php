<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Salesman;

class SalesmanController extends Controller
{
    public function index()
    {
        $salesmans = Salesman::paginate(999);

        return Inertia::render('Salesman/Index', [
            'salesmans' => $salesmans
        ]);
    }
}
