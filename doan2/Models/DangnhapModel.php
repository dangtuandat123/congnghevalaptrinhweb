
<?php
class DangnhapModel extends BaseModel
{
    const TABLE = 'nguoidung';
    public function login($username, $password)
    {
        return $this->selectByValue(self::TABLE,"*", [
            "taikhoan" => "${username}",
            "matkhau" => "${password}",
            
        ]);
    }
}
