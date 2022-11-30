<?php

namespace App\Http\Controllers\Dashboard\Alat;

use Carbon\Carbon;
use App\Models\Alat;
use Illuminate\Http\Request;
use App\Models\JadwalKalibrasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        return view('dashboard.alat.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => Alat::where('user_id', Auth::user()->id)
                ->orderBy($filterBy, $sort)
                ->filter(request(['search', 'status']))
                ->paginate(15)
                ->withQueryString(),
        ]);
    }
    public function tambah()
    {
        $title = 'Tambah Alat';
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
                'name' => 'tambah alat',
                'slug' => 'dashboard/alat/tambah',
            ],
        ];
        return view('dashboard.alat.tambah.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
        ]);
    }
    public function tambahPost(Request $request)
    {
        $alatData = $request->validate([
            'nama_alat' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'kode_alat' => 'required',
            'no_seri' => 'required',
            'spesifikasi' => 'required',
            'keterangan' => 'required',
            'lokasi' => 'required',
        ]);
        $alatData['siklus_kalibrasi'] =
            $request->siklus_kalibrasi > 0 ? $request->siklus_kalibrasi : 0;
        $alatData['user_id'] = Auth::user()->id;
        $alatData['status_kalibrasi'] = 'baru ditambahkan';
        $createAlat = Alat::create($alatData);
        if ($createAlat) {
            return redirect('/dashboard/alat')->with([
                'success' => 'Success',
                'pesan' => 'untuk membuat alat baru',
            ]);
        }
        return redirect('/dashboard/alat')->with([
            'danger' => 'Failed',
            'pesan' => 'untuk membuat alat baru',
        ]);
    }
    public function edit(Alat $detail)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat mengedit alat ini',
            ]);
        }
        $title = 'Edit ' . $detail->nama_alat;
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
                'name' => 'edit ' . $detail->nama_alat,
                'slug' => 'dashboard/alat/' . $detail->id . '/edit',
            ],
        ];
        return view('dashboard.alat.edit.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => $detail,
        ]);
    }
    public function editPost(Alat $detail, Request $request)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return redirect('/dashboard/alat/' . $detail->id)->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat mengedit data alat ini',
            ]);
        }
        $alatData = $request->validate([
            'nama_alat' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'kode_alat' => 'required',
            'no_seri' => 'required',
            'lokasi' => 'required',
            'spesifikasi' => 'required',
            'keterangan' => 'required',
        ]);
        if ($request->siklus_kalibrasi > 0) {
            $alatData['siklus_kalibrasi'] = $request->siklus_kalibrasi;
        } else {
            $alatData['siklus_kalibrasi'] = 0;
        }
        $editAlat = $detail->update($alatData);
        if (!$editAlat) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'mengubah data alat ' . $detail->nama_alat,
            ]);
        }
        return redirect('/dashboard/alat/' . $detail->id)->with([
            'success' => 'Berhasil',
            'pesan' => 'mengubah data alat ' . $detail->nama_alat,
        ]);
    }
    public function hapus($id, Request $request)
    {
        $deleteAlat = Alat::find($id);
        if (
            Auth::user()->id != $deleteAlat->user_id &&
            !Auth::user()->is_admin
        ) {
            return redirect('/dashboard/alat/' . $deleteAlat->id)->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat menghapus data alat ini',
            ]);
        }
        if ($deleteAlat->jadwal->count() > 0) {
            $deleteAlat->jadwal()->delete();
        }
        if ($deleteAlat->images->count() > 0) {
            $deleteAlat->images()->delete();
        }
        $deleteAlat->delete();
        if (!$deleteAlat) {
            return redirect('/dashboard/alat/' . $id)->with([
                'danger' => 'Gagal',
                'pesan' => 'menghapus alat',
            ]);
        }
        return redirect('/dashboard/alat/')->with([
            'success' => 'Berhasil',
            'pesan' => 'menghapus alat',
        ]);
    }
    public function detail(Alat $detail)
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
                'name' => 'detail',
                'slug' => 'dashboard/alat/' . $detail->id,
            ],
        ];
        return view('dashboard.alat.detail.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'detail' => $detail,
            'history' => $detail->jadwal
                ->where('status', '!=', 'jadwal baru')
                ->take(3),
        ]);
    }
    public function tambahJadwal(Alat $detail, Request $request)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' =>
                    'hanya pembuat yang dapat menambahkan jadwal alat ini',
            ]);
        }
        $validatedData = $request->validate([
            'jadwal_kalibrasi' => 'required',
        ]);
        if (
            $detail->jadwal
                ->where('status', '!=', 'sudah terkalibrasi')
                ->first()
        ) {
            return redirect('/dashboard/alat/' . $detail->id)->with([
                'warning' => 'Gagal',
                'pesan' => 'membuat jadwal baru',
            ]);
        }
        if (
            $detail->jadwal
                ->where(
                    'jadwal_kalibrasi',
                    '=',
                    Carbon::parse($request->jadwal_kalibrasi)->format('Y-m-d')
                )
                ->count() > 0
        ) {
            return redirect('/dashboard/alat/' . $detail->id)->with([
                'warning' =>
                    'Tanggal ' .
                    Carbon::parse($request->jadwal_kalibrasi)->format('Y-m-d'),
                'pesan' => 'sudah terekam di dalam database',
            ]);
        }

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['alat_id'] = $detail->id;
        $validatedData['status'] = 'jadwal baru';
        $createJadwal = JadwalKalibrasi::create($validatedData);
        if ($createJadwal) {
            return redirect('/dashboard/alat/' . $detail->id)->with([
                'success' => 'Berhasil',
                'pesan' => 'membuat jadwal baru',
            ]);
        }
        return redirect('/dashboard/alat/' . $detail->id)->with([
            'danger' => 'Gagal',
            'pesan' => 'membuat jadwal baru',
        ]);
    }

    public function sudahTerkalibrasi(Alat $detail, Request $request)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat mengedit alat ini',
            ]);
        }
        $validatedData = $request->validate([
            'kalibrator' => 'required',
            'tanggal_kalibrasi' => 'required',
            'tempat_kalibrasi' => 'required',
        ]);
        if ($request->file('sertifikat_kalibrasi')) {
            $file = $request->file('sertifikat_kalibrasi');
            $filename =
                $validatedData['tanggal_kalibrasi'] .
                '-' .
                $file->getClientOriginalName();
            $file->move(
                public_path('sertifikat/' . $detail->nama_alat . '/'),
                $filename
            );
            $detail->jadwal->first()->sertifikat_kalibrasi =
                'sertifikat/' . $detail->nama_alat . '/' . $filename;
        }
        if ($detail->jadwal->first()->status != 'sudah terkalibrasi') {
            $detail->jadwal->first()->status = 'sudah terkalibrasi';
            $detail->jadwal->first()->jadwal_kalibrasi =
                $validatedData['tanggal_kalibrasi'];
            $detail->jadwal->first()->tempat_kalibrasi =
                $validatedData['tempat_kalibrasi'];
            $detail->jadwal->first()->kalibrator = $validatedData['kalibrator'];
            $detail->jadwal->first()->save();
            $detail->status_kalibrasi = 'sudah terkalibrasi';
            $detail->save();
            if ($request->auto_make_schedule == 'on') {
                JadwalKalibrasi::create([
                    'jadwal_kalibrasi' => Carbon::parse(
                        $validatedData['tanggal_kalibrasi']
                    )->addMonths($detail->siklus_kalibrasi),
                    'status' => 'jadwal baru',
                    'user_id' => $detail->user_id,
                    'alat_id' => $detail->id,
                ]);
            }
            return redirect('/dashboard/alat/' . $detail->id)->with([
                'success' => 'Berhasil',
                'pesan' => 'mengubah status kalibrasi',
            ]);
        }
        return redirect('/dashboard/alat/' . $detail->id)->with([
            'danger' => 'Gagal',
            'pesan' => 'mengubah status kalibrasi',
        ]);
    }
    public function hapusJadwal(Alat $detail)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat menghapus jadwal alat ini',
            ]);
        }
        if ($detail->jadwal()->first()->status = 'jadwal baru') {
            JadwalKalibrasi::find($detail->jadwal()->first()->id)->delete();
            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'menghapus jadwal yang berlangsung',
            ]);
        }
        return back()->with([
            'warning' => 'Gagal',
            'pesan' => 'menghapus jadwal yang berlangsung',
        ]);
    }
    public function hapusSertifikat(Alat $detail, $sertifikat_id)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat menghapus jadwal alat ini',
            ]);
        }
        $sertifikat = JadwalKalibrasi::find($sertifikat_id);
        if (!$sertifikat) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'tidak dapat menemukan history',
            ]);
        }
        if (!$sertifikat->sertifikat_kalibrasi) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'tidak dapat menemukan sertifikat kalibrasi',
            ]);
        }
        File::delete($sertifikat->sertifikat_kalibrasi);
        $sertifikat->sertifikat_kalibrasi = '';
        $sertifikat->save();
        return back()->with([
            'seuccess' => 'Berhasil',
            'pesan' => 'menghapus sertifikat kalibrasi',
        ]);
    }
    public function uploadSertifikat(Alat $detail, Request $request)
    {
        if (Auth::user()->id != $detail->user_id && !Auth::user()->is_admin) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'hanya pembuat yang dapat menghapus jadwal alat ini',
            ]);
        }
        $jadwalKalibrasi = JadwalKalibrasi::find($request->id);
        if ($request->file('sertifikat_kalibrasi')) {
            $extensions = ['pdf'];
            $file = $request->file('sertifikat_kalibrasi');
            if (in_array($file->getClientOriginalExtension(), $extensions)) {
                $filename =
                    $jadwalKalibrasi->jadwal_kalibrasi .
                    '-' .
                    $file->getClientOriginalName();
                $file->move(
                    public_path('sertifikat/' . $detail->nama_alat . '/'),
                    $filename
                );
                $jadwalKalibrasi->sertifikat_kalibrasi =
                    'sertifikat/' . $detail->nama_alat . '/' . $filename;
                $jadwalKalibrasi->save();
            } else {
                return back()->with([
                    'danger' => 'Gagal',
                    'pesan' => 'hanya pdf yang dapat di simpan',
                ]);
            }
        }
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan sertifikat kalibrasi',
        ]);
    }
}
