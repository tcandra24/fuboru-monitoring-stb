<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Customer;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user', 'division')->paginate(999);

        return Inertia::render('Customer/Index', [
            'customers' => $customers
        ]);
    }
}
