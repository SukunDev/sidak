<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Alat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'Hanya admin yang dapat mengakses halaman ini',
            ]);
        }
        $title = 'User List';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
            ],
            [
                'name' => 'admin',
                'slug' => 'dashboard/admin/user',
            ],
            [
                'name' => 'user',
                'slug' => 'dashboard/admin/user',
            ],
        ];
        return view('dashboard.admin.user.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'all_user' => User::where([
                ['is_admin', '=', 0],
                ['active', '=', 1],
            ])->paginate(15),
        ]);
    }
    public function userInActive()
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'Hanya admin yang dapat mengakses halaman ini',
            ]);
        }
        $title = 'User inactive';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
            ],
            [
                'name' => 'admin',
                'slug' => 'dashboard/admin/user',
            ],
            [
                'name' => 'user inactive',
                'slug' => 'dashboard/admin/user/inactive',
            ],
        ];
        return view('dashboard.admin.user.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'all_user' => User::where([
                ['is_admin', '=', 0],
                ['active', '=', 0],
            ])->paginate(15),
        ]);
    }
    public function userDetail(User $user_detail)
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'Hanya admin yang dapat mengakses halaman ini',
            ]);
        }
        $title = $user_detail->name;
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
            ],
            [
                'name' => 'admin',
                'slug' => 'dashboard/admin/user',
            ],
            [
                'name' => 'user',
                'slug' => 'dashboard/admin/user',
            ],
            [
                'name' => $user_detail->username,
                'slug' => 'dashboard/admin/user/' . $user_detail->id,
            ],
        ];
        return view('dashboard.admin.user.detail.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'user_detail' => $user_detail,
            'user_alat' => Alat::where('user_id', $user_detail->id)->paginate(
                15
            ),
        ]);
    }
    public function tambahUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|min:5|string|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => $validator->errors(),
            ]);
        }
        $user = Auth::user();
        if (!$user->is_admin) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'Hanya admin yang dapat melakukan perintah ini',
            ]);
        }
        $createUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        if (!$createUser) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'Menambahkan data pengguna',
            ]);
        }
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'Menambahkan data pengguna',
        ]);
    }
    public function statusUser($id, Request $request)
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'Hanya admin yang dapat mengakses halaman ini',
            ]);
        }
        $user_detail = User::find($id);
        if ($request->status == 'active') {
            $user_detail->active = 1;
        } else {
            $user_detail->active = 0;
        }
        $user_detail->save();
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'mengubah status user',
        ]);
    }
}
