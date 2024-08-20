<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Events\MqttSubscribeEvent;
use App\Models\TabelArusAirModel;
use App\Models\TabelPHModel;
use App\Models\TabelTDSModel;
use App\Models\TabelTempHumModel;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttSubscribeCommand extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe to MQTT topics and handle incoming messages';
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
                        echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);

                        // Parse the message and save to database
                        $this->handleMessage($topic, $message);

                        // Dispatch event with received message and topic
                        event(new MqttSubscribeEvent($message, $topic));
                    }, 0);
                }

                // Start the loop to listen for incoming messages
                $mqtt->loop(true);
            } catch (MqttClientException $e) {
                // Log the error
                $this->error("MQTT error: " . $e->getMessage());

                // Implement a delay before reconnecting
                sleep(5);

                // Attempt to reconnect to the broker
                continue;
            }
        }

        return 0;
    }

    protected function handleMessage($topic, $message)
    {
        switch ($topic) {
            case 'fakbiologi/waterflow':
                TabelArusAirModel::create(['id_area' => 1, 'debit' => $message]);
                break;
            case 'fakbiologi/TDS':
                TabelTDSModel::create(['id_area' => 1, 'ppm' => $message]);
                break;
            case 'fakbiologi/PH':
                TabelPHModel::create(['id_area' => 1, 'ph' => $message]);
                break;
            case 'fakbiologi/humidityDHT':
                $this->tempHumData['humidity'] = $message;
                $this->storeTempHumData();
                break;
            case 'fakbiologi/temperatureDHT':
                $this->tempHumData['temperature'] = $message;
                $this->storeTempHumData();
                break;
                // Tambahkan case untuk topik lain jika diperlukan
            default:
                // Logika default jika topik tidak dikenali
                break;
        }
    }

    // Function to store temperature and humidity data if both are available
    protected function storeTempHumData()
    {
        if ($this->tempHumData['temperature'] !== null && $this->tempHumData['humidity'] !== null) {
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
