<?php namespace koenster\Voys;

use Curl\Curl;

class Voys
{

    /**
     * @var string Hash
     */
    protected $hash;

    /**
     * @var string Phone number (outgoing)
     */
    protected $fromPhoneNumber;

    /**
     * @var string Phone id (outgoing)
     */
    protected $fromPhone;

    /**
     * El constructor
     *
     * @author Koen Blokland Visser
     *
     * @param string $hash
     * @param string|null $fromPhoneNumber
     * @param string|null $fromPhone
     */
    public function __construct($hash, $fromPhoneNumber = null, $fromPhone = null)
    {
        $this->hash = $hash;
        $this->fromPhoneNumber = $fromPhoneNumber;
        $this->fromPhone = $fromPhone;
    }

    /**
     * Get hash
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set hash
     *
     * @author Koen Blokland Visser
     *
     * @param string $hash
     *
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * Get from phone number
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getFromPhoneNumber()
    {
        return $this->fromPhoneNumber;
    }

    /**
     * Set from phone number
     *
     * @author Koen Blokland Visser
     *
     * @param string $fromPhoneNumber
     *
     * @return $this
     */
    public function setFromPhoneNumber($fromPhoneNumber)
    {
        $this->fromPhoneNumber = $fromPhoneNumber;
        return $this;
    }

    /**
     * Get from phone id
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getFromPhone()
    {
        return $this->fromPhone;
    }

    /**
     * Set from phone
     *
     * @author Koen Blokland Visser
     *
     * @param string $fromPhone
     *
     * @return $this
     */
    public function setFromPhone($fromPhone)
    {
        $this->fromPhone = $fromPhone;
        return $this;
    }

    /**
     * Make the call
     *
     * @author Koen Blokland Visser
     *
     * @param $phone
     * @param bool $anonymous
     *
     * @return VoysCall
     */
    public function call($phone, $anonymous = false)
    {
        $data = [
            'a_cli' => $this->getFromPhoneNumber(),
            'a_number' => $this->getFromPhone(),
            'b_number' => $phone,
            'b_cli' => ($anonymous === false ? $this->getFromPhoneNumber() : 'restricted'),
            'auto_answer' => false,
            'hash' => $this->hash
        ];

        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('Content-Length', strlen(json_encode($data)));
        $curl->setHeader('Accept', 'application/json');
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);

        $curl->post('https://api.voipgrid.nl/api/clicktodial/', json_encode($data));

        if ($curl->error) {
            /** @var VoysCall $call */
            $call = new VoysCall([]);
            /** @var array $response */
            /** @var array $errors */
            $response = json_decode($curl->response, true);
            $errors = [];

            foreach ($response as $error) {
                $errors[] = $error;
            }

            return $call->setErrors($errors);
        }

        return new VoysCall(json_decode($curl->response, true));
    }

    public function getCallStatus($callId)
    {
        return new VoysCallStatus($this->hash, $callId);
    }
}