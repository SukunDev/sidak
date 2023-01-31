<?php

namespace App\Http\Controllers\User\Alat;

use App\Models\Alat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlatController extends Controller
{
    public function index()
    {
        $title = 'Alat';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
            ],
            [
                'name' => 'alat',
                'slug' => 'dashboard/alat',
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
        return view('user.alat.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => Alat::orderBy($filterBy, $sort)
                ->filter(request(['search', 'status']))
                ->paginate(15)
                ->withQueryString(),
        ]);
    }
    public function detailIndex(Alat $alat)
    {
        $title = 'Detail';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
            ],
            [
                'name' => 'alat',
                'slug' => 'dashboard/alat',
            ],
            [
                'name' => $alat->nama_alat,
                'slug' => 'dashboard/alat/detail/' . $alat->id,
            ],
        ];
        return view('user.alat.detail.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => $alat,
            'history' => $alat->jadwal
                ->where('status', '!=', 'jadwal baru')
                ->take(3),
        ]);
    }
}
