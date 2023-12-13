
<?php
class DonhangModel extends BaseModel
{
    const TABLE = 'donhang';
    public function getAll()
    {
        return $this->selectAll(self::TABLE);
    }
    public function kiemTraDonHang($idnguoidung, $idtaikhoangame)
    {

        return $this->selectByValue(self::TABLE, "id_donhang", [

            'id_nguoidung' => $idnguoidung,
            'id_taikhoangame' => $idtaikhoangame,

        ]);
    }
    public function insertDonhang($idnguoidung, $idtaikhoangame)
    {

        return $this->insert(self::TABLE, [

            'id_nguoidung' => $idnguoidung,
            'id_taikhoangame' => $idtaikhoangame,

        ]);
    }
    public function donHangGanDay()
    {
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
        // $thoigianhientai = date('Y-m-d H:i:s');
        // $thoigiantruoc5h = date('Y-m-d H:i:s', strtotime($thoigianhientai . ' -300 minutes'));

        $sql = "SELECT donhang.*, nguoidung.taikhoan, hoadon.giatien, hoadon.phuongthucthanhtoan, danhmucgame.tengame
        FROM donhang
        INNER JOIN nguoidung ON donhang.id_nguoidung = nguoidung.id_nguoidung
        INNER JOIN hoadon ON donhang.id_taikhoangame = hoadon.id_taikhoangame
        INNER JOIN taikhoangame ON donhang.id_taikhoangame = taikhoangame.id_taikhoangame
        INNER JOIN danhmucgame ON taikhoangame.id_danhmucgame = danhmucgame.id_danhmucgame
        WHERE hoadon.tinhtrang = 'Thành công'  LIMIT 5;
        ";
        return $this->selectCustom($sql);
    }
    public function donHangHomNay()
    {


        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay_hom_nay = date('Y-m-d');
        $sql = "SELECT id_donhang FROM donhang WHERE DATE(thoigianmua) = '$ngay_hom_nay'";
        return $this->selectCustom($sql);
    }
    public function tatCaDonHang($nguoimua,$id_taikhoangame,$danhmucgame,$thoigian,$gioihan)
    {
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
        // $thoigianhientai = date('Y-m-d H:i:s');
        // $thoigiantruoc5h = date('Y-m-d H:i:s', strtotime($thoigianhientai . ' -300 minutes'));

        $sql = "SELECT donhang.*, nguoidung.taikhoan, hoadon.giatien, hoadon.phuongthucthanhtoan, danhmucgame.tengame,danhmucgame.id_danhmucgame
        FROM donhang
        INNER JOIN nguoidung ON donhang.id_nguoidung = nguoidung.id_nguoidung
        INNER JOIN hoadon ON donhang.id_taikhoangame = hoadon.id_taikhoangame
        INNER JOIN taikhoangame ON donhang.id_taikhoangame = taikhoangame.id_taikhoangame
        INNER JOIN danhmucgame ON taikhoangame.id_danhmucgame = danhmucgame.id_danhmucgame
        WHERE hoadon.tinhtrang = 'Thành công'
        $nguoimua
        $id_taikhoangame
        $danhmucgame
        $thoigian
        $gioihan;
        ";
        // echo $sql;
        // die();
        return $this->selectCustom($sql);
    }
    public function tongSoDonHang()
    {
        $sql = "SELECT COUNT(*) AS tongsodonhang FROM donhang";
        return $this->selectCustom($sql);
    }
}
