<?php

namespace App\Traits;

use App\Models\DetailPemohon;
use App\Models\VerifikatorHasPengajuan;
use Carbon\Carbon;

trait WithDataStatistic
{
    public $todayCount, $weekCount, $monthCount, $total;
    public $todayPercentage, $weekPercentage, $monthPercentage;
    public $totalDataMasukPerHariByStatus1, $totalDataMasukPerHariByStatus2;
    public $labelMonth;
    public $diagram;

    public function getCountData($data)
    {
        // Mendapatkan jumlah data  hari ini
        $this->todayCount = $data::whereDate('created_at', '=', Carbon::today()->toDateString())
            ->count();

        // Mendapatkan jumlah  hari kemarin
        $yesterdayCount = $data::whereDate('created_at', Carbon::yesterday())->count();

        // Menghitung persentase perubahan jumlah data
        $this->todayPercentage = number_format(($yesterdayCount > 0 ? ($this->todayCount - $yesterdayCount) / $yesterdayCount * 100 : 100), 2);

        // Mendapatkan jumlah data  minggu ini
        $this->weekCount = $data::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $this->weekPercentage = $this->compareDataFromLastWeek($data);

        // Mendapatkan jumlah data BusTraffic bulan ini
        $this->monthCount = $data::whereMonth('created_At', '=', Carbon::now()->month)
            ->count();
        $this->monthPercentage = $this->compareDataFromLastMonth($data);

        $this->total = $data::count();
    }

    public function compareDataFromLastWeek($data)
    {
        $now = Carbon::now();
        $todayCount = $this->countByDate($data, $now);
        $lastWeekCount = $this->countLastWeek($data, $now);

        $percentage = $lastWeekCount > 0 ? ($todayCount - $lastWeekCount) / $lastWeekCount * 100 : 100;

        return number_format($percentage, 2);
    }
    public function compareDataFromLastMonth($data)
    {
        // Mendapatkan tanggal awal dan akhir bulan lalu
        $lastMonthStart = now()->subMonth()->startOfMonth()->toDateString();
        $lastMonthEnd = now()->subMonth()->endOfMonth()->toDateString();

        // Mendapatkan tanggal awal dan akhir bulan sekarang
        $thisMonthStart = now()->startOfMonth()->toDateString();
        $thisMonthEnd = now()->endOfMonth()->toDateString();

        // Query untuk jumlah data bulan lalu
        $lastMonthCount = $data::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();

        // Query untuk jumlah data bulan sekarang
        $thisMonthCount = $data::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // Hitung nilai persentasi kenaikan
        $percentage = $lastMonthCount > 0 ? ($thisMonthCount - $lastMonthCount) / $lastMonthCount * 100 : 100;

        // Tampilkan nilai persentasi dengan 2 digit desimal
        return number_format($percentage, 2);
    }
    public function getDataForStatistic($data, $attribute, $value1, $value2)
    {

        $startDate = Carbon::now()->startOfMonth(); // tanggal awal bulan ini
        $endDate = Carbon::now()->endOfMonth(); // tanggal akhir bulan ini

        // Inisialisasi array labelMonth
        $this->labelMonth = [];

        // Loop setiap tanggal mulai dari tanggal awal bulan hingga tanggal akhir bulan
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {

            $this->labelMonth[] = $date->isoFormat('D MMM Y');

            // Hitung jumlah data pada tanggal ini
            $count = $data::whereDate('created_at', $date)->where($attribute, $value1)->count();
            // Tambahkan jumlah data ke dalam array $data
            $this->totalDataMasukPerHariByStatus1[] = $count;

            // Hitung jumlah data pada tanggal ini
            $count = $data::whereDate('created_at', $date)->where($attribute, $value2)->count();
            // Tambahkan jumlah data ke dalam array $data
            $this->totalDataMasukPerHariByStatus2[] = $count;

        }
        $this->diagram = [$data::where($attribute, $value1)->count(), $data::where($attribute, $value2)->count()];
    }
    public static function countByDate($data, $date)
    {
        return $data::whereDate('created_at', $date)->count();
    }
    public static function countLastWeek($data, $now)
    {
        $lastWeek = $now->subWeek();
        $countLastWeek = $data::whereBetween('created_at', [$lastWeek, $now])->count();
        return $countLastWeek;
    }
    public function getTotalPemohon()
    {
        // Mendapatkan jumlah data
        $total = DetailPemohon::count();
        return $total;
    }
    public function getTotalPemohonByStatus($status)
    {
        // Mendapatkan jumlah data
        $total = DetailPemohon::where('status', $status)->count();
        return $total;
    }
    //AMANBANG
    public function getTotalPengajuanPemohon()
    {
        $user = auth()->user();
        // Mendapatkan jumlah data
        $total = DetailPemohon::where('user_id', $user->id)->count();
        return $total;
    }
    public function getTotalPengajuanPemohonByStatus($status)
    {
        // Mendapatkan jumlah data
        $user = auth()->user();
        $total = DetailPemohon::where([
            'user_id' => $user->id,
            'status' => $status,
        ])->count();
        return $total;
    }
    public function getTotalPengajuanVerifikator($status = null)
    {
        // Mendapatkan jumlah data
        $user = auth()->user();
        if ($status) {
            $total = VerifikatorHasPengajuan::where([
                'user_id' => $user->id,
                'status_verifikator' => $status,
            ])->count();
        } else {
            $total = VerifikatorHasPengajuan::where([
                'user_id' => $user->id
            ])->count();
        }
        return $total;
    }
}
