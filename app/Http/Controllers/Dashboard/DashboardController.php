<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
            ],
        ];
        $filterBy = "nama_alat";
        if(request('filter_by')){
            $filterBy = request('filter_by');
        }
        return view('dashboard.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => Alat::orderBy($filterBy,'ASC')
                ->filter(request(['search', 'status']))
                ->paginate(15)
                ->withQueryString(),
        ]);
    }
}
