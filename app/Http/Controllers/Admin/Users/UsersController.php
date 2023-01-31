<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\Alat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
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
                'slug' => 'admin',
            ],
            [
                'name' => 'user',
                'slug' => 'admin/user',
            ],
        ];
        return view('admin.user.index', [
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
                'slug' => 'admin',
            ],
            [
                'name' => 'user inactive',
                'slug' => 'admin/user/inactive',
            ],
        ];
        return view('admin.user.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'all_user' => User::where([
                ['is_admin', '=', 0],
                ['active', '=', 0],
            ])->paginate(15),
        ]);
    }
    public function newUser(Request $request)
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
    public function userDetail(User $user)
    {
        $title = $user->name;
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'admin',
            ],
            [
                'name' => 'user',
                'slug' => 'admin/user',
            ],
            [
                'name' => $user->username,
                'slug' => 'admin/user/' . $user->username,
            ],
        ];
        return view('admin.user.detail.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'user_detail' => $user,
        ]);
    }
    public function statusUser(User $user, Request $request)
    {
        if ($request->status == 'active') {
            $user->active = 1;
        } else {
            $user->active = 0;
        }
        $user->save();
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'mengubah status user',
        ]);
    }
    public function hapusUser($id)
    {
        $user = User::find($id);
        $user->delete();
        if (!$user) {
            return redirect('/admin/user/' . $user->username)->with([
                'danger' => 'Gagal',
                'pesan' => 'menghapus ' . $user->name,
            ]);
        }
        return redirect('/admin/user/')->with([
            'success' => 'Berhasil',
            'pesan' => 'menghapus ' . $user->name,
        ]);
    }
}
