<?php namespace koenster\Voys;

class VoysCall
{

    /**
     * @var bool
     */
    protected $success = false;

    /**
     * @var string
     */
    protected $callId;

    /**
     * @var string
     */
    protected $callFromPhone;

    /**
     * @var string
     */
    protected $callFromPhoneNumber;

    /**
     * @var string
     */
    protected $callToPhoneNumber;

    /**
     * @var string
     */
    protected $callToDisplayPhoneNumber;

    /**
     * @var array
     */
    protected $information = [];

    /**
     * @var array|null
     */
    protected $errors = null;

    /**
     * El constructor
     *
     * @author Koen Blokland Visser
     *
     * @param array $information
     */
    public function __construct(array $information)
    {
        $this->callId = (isset($information['callid']) ? $information['callid'] : null);
        $this->callFromPhone = (isset($information['a_number']) ? $information['a_number'] : null);
        $this->callFromPhoneNumber = (isset($information['a_cli']) ? $information['a_cli'] : null);
        $this->callToPhoneNumber = (isset($information['b_number']) ? $information['b_number'] : null);
        $this->callToDisplayPhoneNumber = (isset($information['b_cli']) ? $information['b_cli'] : null);
        $this->information = $information;

        if (isset($information['callid'])) {
            $this->success = true;
        }
    }

    /**
     * Set errors
     *
     * @author Koen Blokland Visser
     *
     * @param array $errors
     *
     * @return $this
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * Get errors
     *
     * @author Koen Blokland Visser
     *
     * @return array|null
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Is valid
     *
     * @author Koen Blokland Visser
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->success;
    }

    /**
     * Get call from phone number
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getCallId()
    {
        return $this->callId;
    }

    /**
     * Get call from phone (id)
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getCallFromPhone()
    {
        return $this->callFromPhone;
    }

    /**
     * Get call from phone number
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getCallFromPhoneNumber()
    {
        return $this->callFromPhoneNumber;
    }

    /**
     * Get call to phone number
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getCallToPhoneNumber()
    {
        return $this->callToPhoneNumber;
    }

    /**
     * Get call to display from phone number
     *
     * @author Koen Blokland Visser
     *
     * @return string
     */
    public function getCallToDisplayPhoneNumber()
    {
        return $this->callToDisplayPhoneNumber;
    }

    /**
     * Get information
     *
     * @author Koen Blokland Visser
     *
     * @return array
     */
    public function getInformation()
    {
        return $this->information;
    }
}