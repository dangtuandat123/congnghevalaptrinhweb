
<?php
class DangkiModel extends BaseModel
{
    const TABLE = 'nguoidung';
    public function dangki($taikhoan, $matkhau)
    {
       return $this->insert(self::TABLE,[
        'taikhoan'=>"$taikhoan",
        'matkhau'=>"$matkhau",
        
       ]);
    }
    

}
