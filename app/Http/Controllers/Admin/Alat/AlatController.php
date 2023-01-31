<?php

namespace App\Http\Controllers\Admin\Alat;

use Carbon\Carbon;
use App\Models\Alat;
use App\Models\AlatJadwal;
use Illuminate\Http\Request;
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
                'slug' => 'admin',
            ],
            [
                'name' => 'alat',
                'slug' => 'admin/alat',
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
        return view('admin.alat.index', [
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
    public function newIndex()
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
        return view('admin.alat.new.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
        ]);
    }
    public function newPost(Request $request)
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
        $alatData['status_kalibrasi'] = 'belum di jadwalkan';
        $createAlat = Alat::create($alatData);
        if ($createAlat) {
            return redirect('/admin/alat')->with([
                'success' => 'Success',
                'pesan' => 'untuk membuat alat baru',
            ]);
        }
        return redirect('/admin/alat')->with([
            'danger' => 'Failed',
            'pesan' => 'untuk membuat alat baru',
        ]);
    }
    public function editIndex(Alat $alat)
    {
        $title = 'Edit ' . $alat->nama_alat;
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'admin',
            ],
            [
                'name' => 'alat',
                'slug' => 'admin/alat',
            ],
            [
                'name' => 'edit ' . $alat->nama_alat,
                'slug' => 'admin/alat/edit/' . $alat->id,
            ],
        ];
        return view('admin.alat.edit.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => $alat,
        ]);
    }
    public function editPost(Alat $alat, Request $request)
    {
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
        $editAlat = $alat->update($alatData);
        if (!$editAlat) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'mengubah data alat ' . $alat->nama_alat,
            ]);
        }
        return redirect('/admin/alat/detail/' . $alat->id)->with([
            'success' => 'Berhasil',
            'pesan' => 'mengubah data alat ' . $alat->nama_alat,
        ]);
    }
    public function detailIndex(Alat $alat)
    {
        $title = 'Detail';
        $breadcrumbs = [
            [
                'name' => 'dashboard',
                'slug' => 'admin',
            ],
            [
                'name' => 'alat',
                'slug' => 'admin/alat',
            ],
            [
                'name' => $alat->nama_alat,
                'slug' => 'admin/alat/detail/' . $alat->id,
            ],
        ];
        return view('admin.alat.detail.index', [
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'user' => Auth::user(),
            'alat' => $alat,
            'history' => $alat->jadwal
                ->where('status', '!=', 'jadwal baru')
                ->take(3),
        ]);
    }
    public function hapus($id)
    {
        $deleteAlat = Alat::find($id);
        if ($deleteAlat->jadwal->count() > 0) {
            $deleteAlat->jadwal()->delete();
        }
        if ($deleteAlat->images->count() > 0) {
            $deleteAlat->images()->delete();
        }
        $deleteAlat->delete();
        if (!$deleteAlat) {
            return redirect('/admin/alat/detail/' . $id)->with([
                'danger' => 'Gagal',
                'pesan' => 'menghapus alat',
            ]);
        }
        return redirect('/admin/alat/')->with([
            'success' => 'Berhasil',
            'pesan' => 'menghapus alat',
        ]);
    }
    public function tambahJadwal(Alat $alat, Request $request)
    {
        $validatedData = $request->validate([
            'jadwal_kalibrasi' => 'required',
        ]);
        if (
            $alat->jadwal->where('status', '!=', 'sudah terkalibrasi')->first()
        ) {
            return redirect('/dashboard/alat/' . $alat->id)->with([
                'warning' => 'Gagal',
                'pesan' => 'membuat jadwal baru',
            ]);
        }
        if (
            $alat->jadwal
                ->where(
                    'jadwal_kalibrasi',
                    '=',
                    Carbon::parse($request->jadwal_kalibrasi)->format('Y-m-d')
                )
                ->count() > 0
        ) {
            return redirect('/dashboard/alat/' . $alat->id)->with([
                'warning' =>
                    'Tanggal ' .
                    Carbon::parse($request->jadwal_kalibrasi)->format('Y-m-d'),
                'pesan' => 'sudah terekam di dalam database',
            ]);
        }

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['alat_id'] = $alat->id;
        if (
            Carbon::createFromFormat('Y-m-d', $request->jadwal_kalibrasi)->gte(
                Carbon::now()
            )
        ) {
            if (
                Carbon::createFromFormat(
                    'Y-m-d',
                    $request->jadwal_kalibrasi
                )->gte(Carbon::now()->addMonth())
            ) {
                $alat->status_kalibrasi = 'di jadwalkan';
                $alat->save();
            } else {
                $alat->status_kalibrasi = 'persiapan kalibrasi';
                $alat->save();
            }
            $validatedData['status'] = 'jadwal baru';
        } else {
            $validatedData['status'] = 'kadaluarsa';
            $alat->status_kalibrasi = 'kadaluarsa';
            $alat->save();
        }
        $createJadwal = AlatJadwal::create($validatedData);
        if ($createJadwal) {
            return redirect('/admin/alat/detail/' . $alat->id)->with([
                'success' => 'Berhasil',
                'pesan' => 'membuat jadwal baru',
            ]);
        }
        return redirect('/admin/alat/detail/' . $alat->id)->with([
            'danger' => 'Gagal',
            'pesan' => 'membuat jadwal baru',
        ]);
    }
    public function sudahTerkalibrasi(Alat $alat, Request $request)
    {
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
                public_path('sertifikat/' . $alat->nama_alat . '/'),
                $filename
            );
            $alat->jadwal->first()->sertifikat_kalibrasi =
                'sertifikat/' . $alat->nama_alat . '/' . $filename;
        }
        if ($request->file('keberterimaan')) {
            $file = $request->file('keberterimaan');
            $filename =
                $validatedData['tanggal_kalibrasi'] .
                '-' .
                $file->getClientOriginalName();
            $file->move(
                public_path('keberterimaan/' . $alat->nama_alat . '/'),
                $filename
            );
            $alat->jadwal->first()->keberterimaan =
                'keberterimaan/' . $alat->nama_alat . '/' . $filename;
        }
        if ($alat->jadwal->first()->status != 'sudah terkalibrasi') {
            $alat->jadwal->first()->status = 'sudah terkalibrasi';
            $alat->jadwal->first()->jadwal_kalibrasi =
                $validatedData['tanggal_kalibrasi'];
            $alat->jadwal->first()->tempat_kalibrasi =
                $validatedData['tempat_kalibrasi'];
            $alat->jadwal->first()->kalibrator = $validatedData['kalibrator'];
            $alat->jadwal->first()->save();
            $alat->status_kalibrasi = 'sudah terkalibrasi';
            $alat->save();
            if ($request->auto_make_schedule == 'on') {
                AlatJadwal::create([
                    'jadwal_kalibrasi' => Carbon::parse(
                        $validatedData['tanggal_kalibrasi']
                    )->addMonths($alat->siklus_kalibrasi),
                    'status' => 'jadwal baru',
                    'user_id' => $alat->user_id,
                    'alat_id' => $alat->id,
                ]);
            }
            return redirect('/admin/alat/detail/' . $alat->id)->with([
                'success' => 'Berhasil',
                'pesan' => 'mengubah status kalibrasi',
            ]);
        }
        return redirect('/admin/alat/detail/' . $alat->id)->with([
            'danger' => 'Gagal',
            'pesan' => 'mengubah status kalibrasi',
        ]);
    }
    public function hapusJadwal(Alat $alat)
    {
        if ($alat->jadwal()->first()->status = 'jadwal baru') {
            if ($alat->status_kalibrasi != 'sudah terkalibrasi') {
                $alat->status_kalibrasi = 'belum di jadwalkan';
                $alat->save();
            }
            AlatJadwal::find($alat->jadwal()->first()->id)->delete();
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
    public function uploadSertifikat(Alat $alat, Request $request)
    {
        $jadwalKalibrasi = AlatJadwal::find($request->id);
        if ($request->kalibrator) {
            $jadwalKalibrasi->kalibrator = $request->kalibrator;
        }
        if ($request->tempat_kalibrasi) {
            $jadwalKalibrasi->tempat_kalibrasi = $request->tempat_kalibrasi;
        }
        if ($request->file('sertifikat_kalibrasi')) {
            $extensions = ['pdf'];
            $file = $request->file('sertifikat_kalibrasi');
            if (in_array($file->getClientOriginalExtension(), $extensions)) {
                $filename =
                    $jadwalKalibrasi->jadwal_kalibrasi .
                    '-' .
                    $file->getClientOriginalName();
                $file->move(
                    public_path('sertifikat/' . $alat->nama_alat . '/'),
                    $filename
                );
                $jadwalKalibrasi->sertifikat_kalibrasi =
                    'sertifikat/' . $alat->nama_alat . '/' . $filename;
                $jadwalKalibrasi->save();
            } else {
                return back()->with([
                    'danger' => 'Gagal',
                    'pesan' => 'hanya pdf yang dapat di simpan',
                ]);
            }
        }
        if ($request->file('keberterimaan')) {
            $file = $request->file('keberterimaan');
            $filename =
                $jadwalKalibrasi->jadwal_kalibrasi .
                '-' .
                $file->getClientOriginalName();
            $file->move(
                public_path('keberterimaan/' . $alat->nama_alat . '/'),
                $filename
            );
            $jadwalKalibrasi->keberterimaan =
                'keberterimaan/' . $alat->nama_alat . '/' . $filename;
            $jadwalKalibrasi->save();
        }
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan perubahan',
        ]);
    }
    public function hapusSertifikat(Alat $alat, $item_id)
    {
        $sertifikat = AlatJadwal::find($item_id);
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
    public function hapusKeberterimaan(Alat $alat, $item_id)
    {
        $sertifikat = AlatJadwal::find($item_id);
        if (!$sertifikat) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'tidak dapat menemukan history',
            ]);
        }
        if (!$sertifikat->keberterimaan) {
            return back()->with([
                'warning' => 'Gagal',
                'pesan' => 'tidak dapat menemukan keberterimaan',
            ]);
        }
        File::delete($sertifikat->keberterimaan);
        $sertifikat->keberterimaan = '';
        $sertifikat->save();
        return back()->with([
            'seuccess' => 'Berhasil',
            'pesan' => 'menghapus keberterimaan',
        ]);
    }
}
