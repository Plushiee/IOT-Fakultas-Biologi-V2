<?php

namespace App\Http\Controllers;

use App\Models\TabelArusAirModel;
use App\Models\TabelPingModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\TabelPHModel;
use App\Models\TabelPompaModel;
use App\Models\TabelTDSModel;
use App\Models\TabelTempHumModel;

class ApiController extends Controller
{
    public function sendMqtt(Request $request)
    {
        $topic = $request->input('topic');
        $message = $request->input('message');

        MQTT::publish($topic, $message);

        // Kembalikan respon JSON
        return response()->json(['success' => 'Pesan MQTT berhasil dikirim!']);
    }

    private function validDate($date)
    {
        $date = strtotime($date);
        return date('Y-m-d H:i:s', $date);
    }

    public function getPH(Request $request)
    {
        $query = TabelPHModel::query();

        if ($request->has('start_time') && $request->has('end_time')) {
            $startTime = $this->validDate($request->input('start_time'));
            $endTime = $this->validDate($request->input('end_time'));
            $query->whereBetween('created_at', [$startTime, $endTime]);

            $ph = $query->get();
        } else {
            $ph = TabelPHModel::all();
        }

        $formattedData = [
            'total' => $ph->count(),
            'totalNotFiltered' => TabelPHModel::count(),
            'rows' => $ph->map(function ($item) {
                return [
                    'timestamp' => $item->created_at->format('Y-m-d H:i:s'),
                    'id_area' => $item->id_area,
                    'ph' => $item->ph
                ];
            })->toArray()
        ];

        return response()->json($formattedData);
    }

    public function getTDS(Request $request)
    {
        $query = TabelTDSModel::query();

        if ($request->has('start_time') && $request->has('end_time')) {
            $startTime = $this->validDate($request->input('start_time'));
            $endTime = $this->validDate($request->input('end_time'));
            $query->whereBetween('created_at', [$startTime, $endTime]);

            $ph = $query->get();
        } else {
            $ph = TabelTDSModel::all();
        }

        $formattedData = [
            'total' => $ph->count(),
            'totalNotFiltered' => TabelTDSModel::count(),
            'rows' => $ph->map(function ($item) {
                return [
                    'timestamp' => $item->created_at->format('Y-m-d H:i:s'),
                    'id_area' => $item->id_area,
                    'ppm' => $item->ppm
                ];
            })->toArray()
        ];

        return response()->json($formattedData);
    }

    public function getUdara(Request $request)
    {
        $query = TabelTempHumModel::query();

        if ($request->has('start_time') && $request->has('end_time')) {
            $startTime = $this->validDate($request->input('start_time'));
            $endTime = $this->validDate($request->input('end_time'));
            $query->whereBetween('created_at', [$startTime, $endTime]);

            $ph = $query->get();
        } else {
            $ph = TabelTempHumModel::all();
        }

        $formattedData = [
            'total' => $ph->count(),
            'totalNotFiltered' => TabelTempHumModel::count(),
            'rows' => $ph->map(function ($item) {
                return [
                    'timestamp' => $item->created_at->format('Y-m-d H:i:s'),
                    'id_area' => $item->id_area,
                    'temperature' => $item->temperature,
                    'humidity' => $item->humidity,
                ];
            })->toArray()
        ];

        return response()->json($formattedData);
    }

    public function getArusAir(Request $request)
    {
        $query = TabelArusAirModel::query();

        if ($request->has('start_time') && $request->has('end_time')) {
            $startTime = $this->validDate($request->input('start_time'));
            $endTime = $this->validDate($request->input('end_time'));
            $query->whereBetween('created_at', [$startTime, $endTime]);

            $ph = $query->get();
        } else {
            $ph = TabelArusAirModel::all();
        }

        $formattedData = [
            'total' => $ph->count(),
            'totalNotFiltered' => TabelArusAirModel::count(),
            'rows' => $ph->map(function ($item) {
                return [
                    'timestamp' => $item->created_at->format('Y-m-d H:i:s'),
                    'id_area' => $item->id_area,
                    'debit' => $item->debit
                ];
            })->toArray()
        ];

        return response()->json($formattedData);
    }

    public function postPompa(Request $request)
    {
        $request->validate([
            'status' => 'required|in:nyala,mati'
        ]);

        $pompa = new TabelPompaModel();
        $pompa->id_area = (1);
        $pompa->status = $request->input('status');
        if ($request->has('suhu')) {
            $pompa->suhu = $request->input('suhu');
        } else {
            $pompa->suhu = null;
        }
        $pompa->otomatis = $request->boolean('otomatis', false);
        $pompa->save();

        return response()->json(['success' => 'Status pompa berhasil diubah!']);
    }

    public function getDashboard()
    {
        $ph = optional(TabelPHModel::latest()->first())->ph ?? 0;
        $tds = optional(TabelTDSModel::latest()->first())->ppm ?? 0;
        $tempHum = [
            'temperature' => optional(TabelTempHumModel::latest()->first())->temperature ?? 0,
            'humidity' => optional(TabelTempHumModel::latest()->first())->humidity ?? 0,
        ];
        $arusAir = optional(TabelArusAirModel::latest()->first())->debit ?? 0;
        $pompa = TabelPompaModel::latest()->first();
        $ping = optional(TabelPingModel::latest()->first())->ping ?? 0;

        $formattedData = [
            'ph' => $ph,
            'ping' => $ping,
            'tds' => $tds,
            'tempHum' => $tempHum,
            'arusAir' => $arusAir,
            'pompa' => $pompa
        ];

        return response()->json($formattedData);
    }
}
