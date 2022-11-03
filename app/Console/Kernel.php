<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Alat;
use App\Models\UserNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->call(function () {
                $allAlat = Alat::all();
                foreach ($allAlat as $alat) {
                    if ($alat->jadwal->count() > 0) {
                        $jadwalAlat = $alat->jadwal
                            ->where('status', 'jadwal baru')
                            ->first();
                        if ($jadwalAlat->status == 'jadwal baru') {
                            $jadwalKalibrasi = Carbon::parse(
                                $jadwalAlat->jadwal_kalibrasi
                            );
                            $numberDays = $jadwalKalibrasi->diffInDays(
                                Carbon::now()->subDay()
                            );
                            if ($numberDays == 30) {
                                $alat->status_kalibrasi = 'persiapan kalibrasi';
                                $alat->save();
                                UserNotification::create([
                                    'user_id' => $alat->user_id,
                                    'message' =>
                                        '<a href="/dashboard/alat/' .
                                        $alat->id .
                                        '"><p><b>' .
                                        $alat->nama_alat .
                                        ' - ' .
                                        $alat->merk .
                                        '</b> membutuhkan kalibrasi dalam ' .
                                        $numberDays .
                                        ' hari</p></a>',
                                ]);
                            } elseif ($numberDays == 15) {
                                $alat->status_kalibrasi = 'persiapan kalibrasi';
                                $alat->save();
                                UserNotification::create([
                                    'user_id' => $alat->user_id,
                                    'message' =>
                                        '<a href="/dashboard/alat/' .
                                        $alat->id .
                                        '"><p><b>' .
                                        $alat->nama_alat .
                                        ' - ' .
                                        $alat->merk .
                                        '</b> membutuhkan kalibrasi dalam ' .
                                        $numberDays .
                                        ' hari</p></a>',
                                ]);
                            } elseif ($numberDays <= 7) {
                                if ($numberDays < 1) {
                                    UserNotification::create([
                                        'user_id' => $alat->user_id,
                                        'message' =>
                                            '<a href="/dashboard/alat/' .
                                            $alat->id .
                                            '"><p>Status <b>' .
                                            $alat->nama_alat .
                                            ' - ' .
                                            $alat->merk .
                                            '</b> Menjadi Kadaluarsa</p></a>',
                                    ]);
                                    $jadwalAlat->status = 'kadaluarsa';
                                    $jadwalAlat->save();
                                    $alat->status_kalibrasi = 'kadaluarsa';
                                    $alat->save();
                                } else {
                                    $alat->status_kalibrasi =
                                        'persiapan kalibrasi';
                                    $alat->save();
                                    UserNotification::create([
                                        'user_id' => $alat->user_id,
                                        'message' =>
                                            '<a href="/dashboard/alat/' .
                                            $alat->id .
                                            '"><p><b>' .
                                            $alat->nama_alat .
                                            ' - ' .
                                            $alat->merk .
                                            '</b> membutuhkan kalibrasi dalam ' .
                                            $numberDays .
                                            ' hari</p></a>',
                                    ]);
                                }
                            }
                        }
                    }
                }
            })
            ->description('cek jadwal alat')
            ->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
