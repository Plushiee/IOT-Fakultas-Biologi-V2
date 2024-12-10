<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Events\MqttSubscribeEvent;
use App\Models\TabelArusAirModel;
use App\Models\TabelPHModel;
use App\Models\TabelPingModel;
use App\Models\TabelTDSModel;
use App\Models\TabelTempHumModel;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttSubscribeCommand extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe ke topik MQTT and menghandle pesan yang masuk';
    protected $tempHumData = [
        'temperature' => null,
        'humidity' => null,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    // Implementasi logika untuk berlangganan ke topik MQTT
    public function handle()
    {
        while (true) {
            try {
                $mqtt = MQTT::connection();

                // Array of topics to subscribe
                $topics = [
                    'fakbiologi/waterflow',
                    'fakbiologi/totalmilliLiters',
                    'fakbiologi/humidityDHT',
                    'fakbiologi/temperatureDHT',
                    'fakbiologi/TDS',
                    'fakbiologi/ping',
                    'fakbiologi/esp8266_1',
                    'fakbiologi/error_1',
                    'fakbiologi/esp8266_2',
                    'fakbiologi/PH',
                ];

                // Subscribe to each topic
                foreach ($topics as $topic) {
                    $mqtt->subscribe($topic, function (string $topic, string $message) {

                        $this->handleMessage($topic, $message);

                        event(new MqttSubscribeEvent($message, $topic));
                    }, 0);
                }

                // Start the loop to listen for incoming messages
                $mqtt->loop(true);
            } catch (MqttClientException $e) {

                $this->error("MQTT error: " . $e->getMessage());

                sleep(5);

                continue;
            }
        }

        return 0;
    }

    // Fungsi Handle message yang masuk
    protected function handleMessage($topic, $message)
    {
        switch ($topic) {
            case 'fakbiologi/waterflow':
                if ($this->isBedaData('TabelArusAirModel', 'debit', $message)) {
                    TabelArusAirModel::create(['id_area' => 1, 'debit' => $message]);
                }
                break;
            case 'fakbiologi/TDS':
                if ($this->isBedaData('TabelTDSModel', 'ppm', $message)) {
                    TabelTDSModel::create(['id_area' => 1, 'ppm' => $message]);
                }
                break;
            case 'fakbiologi/PH':
                if ($this->isBedaData('TabelPHModel', 'ph', $message)) {
                    TabelPHModel::create(['id_area' => 1, 'ph' => $message]);
                }
                break;
            case 'fakbiologi/humidityDHT':
                $this->tempHumData['humidity'] = $message;
                $this->storeTempHumData();
                break;
            case 'fakbiologi/temperatureDHT':
                $this->tempHumData['temperature'] = $message;
                $this->storeTempHumData();
                break;
            case 'fakbiologi/ping':
                if ($this->isBedaData('TabelPingModel', 'ping', $message)) {
                    TabelPingModel::create(['id_area' => 1, 'ping' => $message]);
                }
                break;
            default:
                break;
        }
    }

    // fungsi menyimpan data suhu dan kelembaban dalam satu Tabel
    protected function storeTempHumData()
    {
        $lastRecord = TabelTempHumModel::latest('created_at')->first();
        if ($this->tempHumData['temperature'] !== null && $this->tempHumData['humidity'] !== null) {
            $isDifferent = !$lastRecord ||
                $lastRecord->temperature != $this->tempHumData['temperature'] ||
                $lastRecord->humidity != $this->tempHumData['humidity'];

            if ($isDifferent) {
                TabelTempHumModel::create([
                    'id_area' => 1,
                    'temperature' => $this->tempHumData['temperature'],
                    'humidity' => $this->tempHumData['humidity']
                ]);

                // Reset data after saving
                $this->tempHumData['temperature'] = null;
                $this->tempHumData['humidity'] = null;
            }
        }
    }

    // Fungsi cek apakah data berbeda
    protected function isBedaData($model, $column, $newValue)
    {
        $lastRecord = app($model)::latest('created_at')->first();
        return !$lastRecord || $lastRecord->$column != $newValue;
    }
}
