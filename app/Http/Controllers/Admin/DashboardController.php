<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Branch;
use App\Models\Division;
use App\Models\Customer;
use App\Models\Stb;
use App\Models\Banner;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $user_count = User::count();
        // $branch_count = Branch::count();
        // $divisi_count = Division::count();
        // $customer_count = Customer::count();

        // $activeStb = MasterStb::withSum('detailStb', 'omset')
        // ->when(Auth::user()->kode_area, function($query){
        //     $query->where('kode_area', Auth::user()->kode_area);
        // })
        // ->when(Auth::user()->kode_pelanggan, function($query){
        //     $query->where('kode_pelanggan', Auth::user()->kode_pelanggan);
        // })->whereDate('periode_awal', '<=', Carbon::now())
        // ->whereDate('periode_akhir', '>=', Carbon::now())
        // ->take(5)->orderBy('periode_awal', 'desc')->get();
        $masterStb = Stb::when(Auth::user()->kode_area, function($query){
            $query->where('area', Auth::user()->kode_area);
        })
        ->when(Auth::user()->kode_pelanggan, function($query){
            $query->where('kdplg', Auth::user()->kode_pelanggan);
        })
        ->whereNotNull('approve3date')
        ->whereNull('is_insert')
        ->orderBy('approve3date', 'desc')
        ->take(5)->get();

        $activeBanner = Banner::where('KdPlg', '<>' , '')
        ->where(function($query){
            $query->where('ispengajuan', true)->whereNull('tglpengiriman');
        })
        ->orWhere(function($query){
            $query->whereRaw("tglpengiriman < tglpengajuan");
        })
        ->orderBy('tglpengajuan', 'desc')
        ->take(5)->get();

        return Inertia::render('Dashboard/Index', [
            // 'user_count' => $user_count,
            // 'branch_count' => $branch_count,
            // 'division_count' => $divisi_count,
            // 'customer_count' => $customer_count,
            'activeStb' => $masterStb,
            'activeBanner' => $activeBanner,
        ]);
    }
}
