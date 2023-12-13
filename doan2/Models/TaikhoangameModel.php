
<?php
class TaikhoangameModel extends BaseModel
{
    const TABLE = 'taikhoangame';
    public function hienThiAllNick($iddanhmucgame, $gioihan)
    {

        return $this->selectByValue(
            self::TABLE,
            "id_taikhoangame, giatien, giamgia,img,mota,loaidangki",
            [
                'id_danhmucgame' => $iddanhmucgame,
                'tinhtrang' => 'chuaban',
                'trangthai' => 'Bật',


            ],
            $gioihan
        );
    }
    public function getAll()
    {

        return $this->selectAll(self::TABLE);
    }
    public function loctaikhoan($id_danhmucgame, $maso, $loaidangki, $giatien, $sapxeptheo, $gioihan = "")
    {
        $sql = "SELECT id_taikhoangame, giatien, giamgia,img,mota,loaidangki FROM taikhoangame
        WHERE id_danhmucgame = $id_danhmucgame 
        AND tinhtrang = 'chuaban' 
        AND trangthai ='Bật'
        $maso 
        $loaidangki
        $giatien
        $sapxeptheo
        $gioihan";
        return $this->selectCustom($sql);
    }


    public function hienThiTaiKhoan($id_taikhoangame)
    {
        return $this->selectByValue(
            self::TABLE,
            "id_taikhoangame,img,giatien,id_danhmucgame,motachitiet,mota,loaidangki,giamgia,hinhanhchitiet",
            [
                'id_taikhoangame' => $id_taikhoangame,
                'tinhtrang' => 'chuaban',
                'trangthai' =>'Bật',

            ]
        );
    }
    public function soLuongTaiKhoan($id_danhmucgame)
    {
        return $this->selectByValue(
            self::TABLE,
            "COUNT(*)",
            [
                'id_danhmucgame' => $id_danhmucgame,
                'tinhtrang' => 'chuaban',
                'trangthai' =>'Bật',
            ]
        );
    }
   
    public function updateTaiKhoanGame($id_taikhoangame)
    {
        return $this->update("taikhoangame", [
            "tinhtrang" => "daban",
            'trangthai' =>'Tắt',

        ], [
            "id_taikhoangame" => $id_taikhoangame,
        ]);
    }
   
    public function kiemTraChuaBan($id_taikhoangame)
    {
        return $this->selectByValue(
            self::TABLE,'id_taikhoangame',
            [
                "id_taikhoangame" =>$id_taikhoangame,
                "tinhtrang" => "chuaban",
                'trangthai' =>'Bật',
        
            ]
        );
    }
    public function hienThiTaiKhoanGameAdmin($tengame,$tinhtrang,$id_danhmucgame,$gioihan){
        $sql= "SELECT taikhoangame.*,danhmucgame.tengame FROM taikhoangame 
        INNER JOIN danhmucgame ON taikhoangame.id_danhmucgame = danhmucgame.id_danhmucgame
        WHERE danhmucgame.tengame LIKE '%$tengame%'
        $tinhtrang
        $id_danhmucgame
        $gioihan";
       
        return $this->selectCustom($sql);
    }
    public function themTaiKhoanGame($id_taikhoangame,$taikhoan,$matkhau,$thumbnal,$giatien,$giamgia, $id_danhmucgame,$tinhtrang,$loaidangki,$motangan,$motachitiet,$hinhanhchitiet){
        return $this->insert(self::TABLE,[

            'id_taikhoangame'=>$id_taikhoangame,
            'username' => $taikhoan,
            'password' => $matkhau,
            'img' => $thumbnal,
            'giatien' => $giatien,
            'giamgia' => $giamgia,
            'id_danhmucgame'=> $id_danhmucgame,
            'trangthai'=>$tinhtrang,
            'loaidangki'=>$loaidangki,
            'mota'=>$motangan,
            'motachitiet'=>$motachitiet,
            'hinhanhchitiet'=>$hinhanhchitiet,



        ]);
    }
    public function capNhapTaiKhoan($id_taikhoangame,$taikhoan,$matkhau,$thumbnal,$giatien,$giamgia, $id_danhmucgame,$tinhtrang,$loaidangki,$motangan,$motachitiet,$hinhanhchitiet,$trangthai){
        return $this->update(self::TABLE,[

            'username' => $taikhoan,
            'password' => $matkhau,
            'img' => $thumbnal,
            'giatien' => $giatien,
            'giamgia' => $giamgia,
            'id_danhmucgame'=> $id_danhmucgame,
            'trangthai'=>$tinhtrang,
            'loaidangki'=>$loaidangki,
            'mota'=>$motangan,
            'motachitiet'=>$motachitiet,
            'hinhanhchitiet'=>$hinhanhchitiet,
            'trangThai' => $trangthai,

        ],[
            'id_taikhoangame'=>$id_taikhoangame,

        ]);
    }
    public function tongsotaikhoan()  {
        $sql = "SELECT COUNT(id_taikhoangame) FROM taikhoangame";
        $kq = $this->selectCustom($sql);
        return $kq[0]['COUNT(id_taikhoangame)'];
        
    }
    public function tongsotaikhoandaban()  {
        $sql = "SELECT COUNT(id_taikhoangame) FROM taikhoangame WHERE tinhtrang = 'daban'";
        $kq = $this->selectCustom($sql);
        return $kq[0]['COUNT(id_taikhoangame)'];
        
    }


}
