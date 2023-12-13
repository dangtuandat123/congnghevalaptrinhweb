<?php
class Database
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSSWORD = '';
    const DB_NAME = 'doancoso2';


    public function connect()
    {
        $connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSSWORD, self::DB_NAME);
        mysqli_set_charset($connect, 'utf8');
        if (mysqli_connect_errno() === 0) {

            return $connect;
        }
        return false;
    }
    
}
