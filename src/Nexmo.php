<?php

namespace VVinners\Messenger;

class Nexmo
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $_client = null;

    public function __construct() {
        $basic  = new \Nexmo\Client\Credentials\Basic(env('NEXMO_API_KEY'), env('NEXMO_API_SECRET'));
        $this->_client = new \Nexmo\Client($basic);
    }

    public function send($to, $content) {
        return $message = $this->_client->message()->send([
            'type' => 'unicode',
            'to' => $to,
            'from' => env('MESSENGER_FROM_NAME'),
            'text' => $content
        ]);
    }

}
