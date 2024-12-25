<?php

namespace App\Http\Controllers;

use App\Models\TabelArusAirModel;
use Illuminate\Http\Request;
use App\Models\TabelPompaModel;
use App\Models\TabelTDSModel;
use App\Models\TabelTempHumModel;
use Carbon\Carbon;

class UmumController extends Controller
{
    public function dashboardUmum()
    {
        return view('umum.dashboard-umum');
    }

    public function rangkuman(Request $request)
    {
        $s = $request->query('s');
        $e = $request->query('e');

        // Logika untuk menangani rentang tanggal seperti sebelumnya
        if (!$s && !$e) {
            $rawDatta = [
                'arus' => TabelArusAirModel::whereBetween('created_at', [Carbon::now()->subDays(32)->toDateString(), Carbon::now()->toDateString()])->get(),
                'tds' => TabelTDSModel::whereBetween('created_at', [Carbon::now()->subDays(32)->toDateString(), Carbon::now()->toDateString()])->get(),
                'udara' => TabelTempHumModel::whereBetween('created_at', [Carbon::now()->subDays(32)->toDateString(), Carbon::now()->toDateString()])->get(),
            ];

            $data = [
                'arus' => $rawDatta['arus']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('debit'), 3);
                }),
                'tds' => $rawDatta['tds']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('ppm'), 3);
                }),
                'temperature' => $rawDatta['udara']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('temperature'), 3);
                }),
                'humidity' => $rawDatta['udara']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('humidity'), 3);
                }),
            ];
        } else {
            if ($s && !$e) {
                $e = Carbon::now()->toDateString();
            }

            if (!$s && $e) {
                $s = Carbon::parse($e)->subDays(32)->toDateString();
            }

            $rawDatta = [
                'arus' => TabelArusAirModel::whereBetween('created_at', [$s, $e])->get(),
                'tds' => TabelTDSModel::whereBetween('created_at', [$s, $e])->get(),
                'udara' => TabelTempHumModel::whereBetween('created_at', [$s, $e])->get(),
            ];

            $data = [
                'arus' => $rawDatta['arus']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('debit'), 3);
                }),
                'tds' => $rawDatta['tds']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('ppm'), 3);
                }),
                'temperature' => $rawDatta['udara']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('temperature'), 3);
                }),
                'humidity' => $rawDatta['udara']->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('Y-m-d');
                })->map(function ($item) {
                    return round($item->avg('humidity'), 3);
                }),
            ];
        }

        return view('umum.rangkuman', ['data' => $data]);
    }

    public function tabelPH()
    {
        return view('umum.tabelPH');
    }

    public function tabelTDS()
    {
        return view('umum.tabelTDS');
    }

    public function tabelUdara()
    {
        return view('umum.tabelUdara');
    }

    public function tabelArus()
    {
        return view('umum.tabelArus');
    }

    public function tabelReservoir()
    {
        return view('umum.tabelReservoir');
    }
}
