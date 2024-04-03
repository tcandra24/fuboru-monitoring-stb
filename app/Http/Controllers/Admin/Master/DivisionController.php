<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Division;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::paginate(999);

        return Inertia::render('Division/Index', [
            'divisions' => $divisions
        ]);
    }
}
