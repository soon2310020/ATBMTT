<?php
class Connection
{

    public function getConnection() {
        try {
            $connection = new PDO('mysql:host=localhost;dbname=atbmtt;charset=utf8',
                'root', '');
        } catch (PDOException $e) {
            die("Kết nối CSDL theo PDO thất bại: " . $e->getMessage());
        }

        return $connection;
    }

    public function closeConnection() {
        $this->connection = null;
    }

}