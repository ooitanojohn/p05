<?php
/* DB */
class ArrayUserData
{
    private $id;
    private $pass;

    public function __construct($id, $pass)
    {
        $this->id = $id;
        $this->pass = $pass;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getpass()
    {
        return $this->pass;
    }
}
