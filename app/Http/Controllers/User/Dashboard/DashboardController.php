<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Models\Alat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $filterBy = 'created_at';
        $sort = 'ASC';
        if (request('filter_by')) {
            $filterBy = request('filter_by');
            if ($filterBy == 'created_at') {
                $sort = 'DESC';
            }
        }
        return view('user.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => Alat::orderBy($filterBy, $sort)
                ->filter(request(['search', 'status']))
                ->paginate(15)
                ->withQueryString(),
        ]);
    }
}
