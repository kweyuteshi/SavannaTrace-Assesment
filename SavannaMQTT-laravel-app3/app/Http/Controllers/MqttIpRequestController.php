<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use PhpMqtt\Client\Facades\MQTT;

class MqttIpRequestController extends Controller
{
    //This function gets the ip address from the getIpAdress() function and displays it to the user when they go to http://localhost:8000/mqtt-ip-request Route
    public function requestAndPublishIpAddress(): JsonResponse
    {
        $ipAddress = $this->connectToMqttAndFetchIpAddress();

        return response()->json(['The ip_address is' => $ipAddress]);
    }

    /*This function tries to establish a connection with the MQTT broker and tries again every 5 seconds until a connection is established or an error occurs */
    private function connectToMqttAndFetchIpAddress(): string
    {
        do {
            try {
                //initialising an instance of the MQTT client
                $mqttClient = MQTT::connection('default');
    
                if (!$mqttClient->isConnected()) {
                    $mqttClient->connect();
                    Log::info('Connected to MQTT broker');
                }
            } catch (\Exception $exception) {
                Log::error('Failed to connect to MQTT broker. Retrying in 5 seconds...');
                sleep(5);
            }
        } while (!MQTT::connection('default')->isConnected());

        return $this->requestAndPublishIpAddressLogic();
    }

    private function requestAndPublishIpAddressLogic(): string
    {
        $ipAddress = $this->getIpAddress(); 

        // Publish the IP address to a specific topic
        MQTT::connection('default')->publish('ip-address-topic', $ipAddress, 0, false);

        Log::info("IP address {$ipAddress} published to 'ip-address-topic'");

        return $ipAddress;
    }

    /*This function runs the ipconfig command to get the IP address Then uses Regular expression to extract the IPV4 address 
    This is the logic that would be used used on a windows machine*/
    private function getIpAddress(): string
    {
        //  'ipconfig' command 
        $output = shell_exec('ipconfig');
    
        // Using regular expressions 
        preg_match('/IPv4 Address[^:]+:\s+([^\r\n]+)/', $output, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        // If 'ipconfig' command fails, return a default IP address
        return '127.0.0.1';
    }
}
