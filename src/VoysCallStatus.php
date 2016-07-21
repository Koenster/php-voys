<?php namespace koenster\Voys;

use Curl\Curl;

class VoysCallStatus
{

    public $response;


    /**
     * Make the call
     *
     * @author Koen Blokland Visser
     *
     * @param $hash
     * @param $callId
     *
     * @return array
     */
    public function __construct($hash, $callId)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('Accept', 'application/json');
        $curl->setHeader('Hash', $hash);
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);

        $curl->get('https://api.voipgrid.nl/api/clicktodial/' . $callId . '/');

        /** @var array $response */
        $this->response = json_decode($curl->response, true);
    }
}