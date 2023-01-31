<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Alat;
use App\Models\Notification;
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
                'slug' => 'admin',
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
        return view('admin.index', [
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
