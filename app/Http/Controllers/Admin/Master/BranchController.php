<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(999);

        return Inertia::render('Branch/Index', [
            'branches' => $branches
        ]);
    }
}
