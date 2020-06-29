<?php

class PremiumMember extends Member {
    private $_inDoorInterests;
    private $_outDoorIntersts;

    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @param mixed $outDoorIntersts
     */
    public function setOutDoorIntersts($outDoorIntersts)
    {
        $this->_outDoorIntersts = $outDoorIntersts;
    }

    /**
     * @return mixed
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorIntersts()
    {
        return $this->_outDoorIntersts;
    }
}