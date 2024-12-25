<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabelPompaModel;
use PhpMqtt\Client\Facades\MQTT;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        $pompaStatus = TabelPompaModel::latest()->first();
        if ($pompaStatus == null) {
            $pompaStatus = new TabelPompaModel();
            $pompaStatus->status = 'mati';
            $pompaStatus->otomatis = false;
            $pompaStatus->suhu = 0;
        }
        return view('admin.dashboard-admin', compact('pompaStatus'));
    }

    public function rangkuman(Request $request)
    {
        $s = $request->query('s');
        $e = $request->query('e');

        // Logika untuk menangani rentang tanggal seperti sebelumnya
        if (!$s && !$e) {
            $data = TabelPompaModel::all();
        } else {
            if ($s && !$e) {
                $e = Carbon::now()->toDateString();
            }

            if (!$s && $e) {
                $s = Carbon::parse($e)->subDays(32)->toDateString();
            }

            $data = TabelPompaModel::whereBetween('created_at', [$s, $e])->get();
        }

        // Format data untuk grafik
        $formattedData = [
            'labels' => $data->pluck('created_at')->map(fn($date) => Carbon::parse($date)->format('d-m-Y'))->toArray(),
            'tds' => $data->pluck('tds')->toArray(),
            'udara' => $data->pluck('udara')->toArray(),
            'arus' => $data->pluck('arus')->toArray(),
        ];

        return view('admin.rangkuman', ['data' => $formattedData]);
    }


    public function tabelPH()
    {
        return view('admin.tabelPH');
    }
    public function tabelTDS()
    {
        return view('admin.tabelTDS');
    }
    public function tabelUdara()
    {
        return view('admin.tabelUdara');
    }
    public function tabelArus()
    {
        return view('admin.tabelArusAir');
    }
}
