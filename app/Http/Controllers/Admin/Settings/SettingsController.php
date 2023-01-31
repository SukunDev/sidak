<?php

namespace App\Http\Controllers\Admin\Settiings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $title = 'Settings';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'admin',
            ],
            [
                'name' => 'settings',
                'slug' => 'admin/settings',
            ],
        ];
        return view('admin.settings.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
        ]);
    }
    public function settings(Request $request)
    {
        if ($request->settings == 'ubah_pengguna') {
            $updateUser = User::find(Auth::user()->id);
            $updateUser['email'] = $request->email;
            $updateUser['name'] = $request->name;
            $updateUser->save();
            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'mengubah data pengguna',
            ]);
        } elseif ($request->settings == 'ubah_password') {
            $request->validate([
                'current_password' => ['required', new MatchOldPassword()],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

            User::find(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'mengubah password pengguna',
            ]);
        }
    }
}
