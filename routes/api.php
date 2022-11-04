<?php

use Carbon\Carbon;
use App\Models\Alat;
use App\Models\User;
use App\Models\AlatImage;
use Illuminate\Http\Request;
use App\Models\UserNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
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
    $image = AlatImage::find($id);
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
Route::post('/update-notification/{id}', function ($id, Request $request) {
    $userNotification = UserNotification::find($id);
    if (!$userNotification->has_been_view) {
        $userNotification->has_been_view = 1;
        $userNotification->save();
    }
});
Route::get('/search', function (Request $request) {
    return Alat::where(
        'nama_alat',
        'like',
        '%' . $request->search . '%'
    )->get();
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
    $alat_image = new AlatImage();
    if ($request->file('dropzone-file')) {
        $file = $request->file('dropzone-file');
        $filename = $file->getClientOriginalName();
        $alat_image['name'] = $filename;
        $alat_image['path'] = '/image/alat/' . $filename;
        $alat_image['size'] = $file->getSize();
        $alat_image['user_id'] = $request->user_id;
        $alat_image['alat_id'] = $request->alat_id;
        if (AlatImage::where('name', $filename)->count() > 0) {
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
