<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabelPompaModel;
use PhpMqtt\Client\Facades\MQTT;

class MainController extends Controller
{
    public function dashboard()
    {
        $pompaStatus = TabelPompaModel::latest()->first();
        if ($pompaStatus == null) {
            $pompaStatus = new TabelPompaModel();
            $pompaStatus->status = 'mati';
            $pompaStatus->otomatis = false;
            $pompaStatus->suhu = 0;
        }
        return view('main.dashboard', compact('pompaStatus'));
    }
    public function tabelPH()
    {
        return view('main.tabelPH');
    }
    public function tabelTDS()
    {
        return view('main.tabelTDS');
    }
    public function tabelUdara()
    {
        return view('main.tabelUdara');
    }
    public function tabelArus()
    {
        return view('main.tabelArusAir');
    }
}
