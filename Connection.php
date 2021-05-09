<?php
class Connection
{
    public $con;
    function  getconect()
    {
        try
        {
            $this->con= $conn = new mysqli('localhost','root', '','atbmtt');

        }
        catch (Exception $e)
        {
            die("kết nối không thành công: ".$e->getMessage());
        }

        return $this->con;
    }
    function closeConnect()
    {
        $this->con->close();
    }

}