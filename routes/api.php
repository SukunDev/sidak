<?php

use App\Models\Alat;
use App\Models\User;
use App\Models\AlatImages;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\UserNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/delete-image/{id}', function ($id, Request $request) {
    $image = AlatImages::find($id);
    if (
        $request->user_id != $image->user_id &&
        !User::find($request->user_id)->is_admin
    ) {
        return response()->json(
            [
                'success' => 'false',
                'message' => 'hanya pembuat yang dapat menghapus gambar ini',
            ],
            302
        );
    }
    $deleteImageLocation = File::delete(public_path($image->path));
    if (!$deleteImageLocation) {
        return response()->json(
            [
                'success' => 'false',
                'message' => 'gagal menghapus gambar ini location',
            ],
            302
        );
    }
    $deleteImage = $image->delete();
    if (!$deleteImage) {
        return response()->json(
            [
                'success' => 'false',
                'message' => 'gagal menghapus gambar ini database',
            ],
            302
        );
    }
    return response()->json(
        [
            'success' => 'true',
            'message' => 'berhasil menghapus gambar ini',
        ],
        302
    );
});

Route::post('/upload-image', function (Request $request) {
    if (
        $request->user_id != Alat::find($request->alat_id)->user_id &&
        !User::find($request->user_id)->is_admin
    ) {
        return response()->json(
            [
                'success' => 'false',
                'message' => 'hanya pembuat yang dapat menyimpan gambar ini',
            ],
            302
        );
    }
    $alat_image = new AlatImages();
    if ($request->file('dropzone-file')) {
        $file = $request->file('dropzone-file');
        $filename = $file->getClientOriginalName();
        $alat_image['name'] = $filename;
        $alat_image['path'] = '/image/alat/' . $filename;
        $alat_image['size'] = $file->getSize();
        $alat_image['user_id'] = $request->user_id;
        $alat_image['alat_id'] = $request->alat_id;
        if (AlatImages::where('name', $filename)->count() > 0) {
            return response()->json(
                [
                    'success' => 'false',
                    'message' => 'anda sudah menyimpan gambar ini',
                ],
                302
            );
        }
    }
    $file->move(public_path('image/alat/'), $filename);
    $alat_image->save();
    return response()->json([
        'success' => 'true',
        'result' => [
            'name' => $alat_image->name,
            'path' => $alat_image->path,
            'size' => $alat_image->size,
            'id' => $alat_image->id,
        ],
    ]);
});
Route::post('/update-notification/{id}', function ($id, Request $request) {
    $notification = Notification::find($id);
    if (
        $notification->usernotifications
            ->where('user_id', $request->user_id)
            ->count() < 1
    ) {
        UserNotification::create([
            'user_id' => $request->user_id,
            'notification_id' => $id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'berhasil mengupdate notification',
        ]);
    }
});
Route::get('/search', function (Request $request) {
    return Alat::where('nama_alat', 'like', '%' . $request->search . '%')
        ->orWhere('merk', 'like', '%' . $request->search . '%')
        ->orWhere('kode_alat', 'like', '%' . $request->search . '%')
        ->get();
});
