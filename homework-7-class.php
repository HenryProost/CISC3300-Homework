<?php

class Name
{
    private $fName;
    private $lName;

    public function constructor($fName, $lName)
    {
        $this->fName = $fName;
        $this->lName = $lName;
    }

    public function getFName()
    {
        return $this->fName;
    }

    public function getLName()
    {
        return $this->lName;
    }

    public function setFName()
    {
        $this->fName = $fName;
    }

    public function setLName()
    {
        $this->lName = $lName;
    }
}