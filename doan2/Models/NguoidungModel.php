
<?php
class NguoidungModel extends BaseModel
{
    const TABLE = 'nguoidung';
    public function getAll()
    {
        return $this->selectAll(self::TABLE);
    }
    public function getUser($id_nguoidung)
    {
        return $this->selectByValue(
            self::TABLE,
            'id_nguoidung,taikhoan,email,sodienthoai',
            [
                'id_nguoidung' => $id_nguoidung,
            ],
        );
    }
    public function updateThongTinNguoiDung($sodienthoai, $email, $id_nguoidung)
    {
        return $this->update(
            self::TABLE,
            [
                'sodienthoai' => $sodienthoai,
                'email' =>  $email,
            ],
            [
                'id_nguoidung' => $id_nguoidung,
            ]
        );
    }
    public function upadateMatKhau($matkhaumoi, $id_nguoidung)
    {
        return $this->update(
            self::TABLE,
            [
                'matkhau' => $matkhaumoi,

            ],
            [
                'id_nguoidung' => $id_nguoidung,
            ]
        );
    }
    public function kiemTraMatKhau($id_nguoidung)
    {
        return $this->selectByValue(
            self::TABLE,
            'matkhau',
            [
                'id_nguoidung' => $id_nguoidung,
            ],
        );
    }
    public function showTaiKhoanDaMua($id_nguoidung, $gioihan = "", $maso = "", $giatien = "", $loctheongay = "")
    {
        $sql = "SELECT donhang.*, danhmucgame.tengame, CAST(taikhoangame.giatien - (taikhoangame.giatien * taikhoangame.giamgia / 100) AS SIGNED) AS giatien,taikhoangame.password, taikhoangame.username FROM donhang INNER JOIN taikhoangame ON donhang.id_taikhoangame = taikhoangame.id_taikhoangame INNER JOIN danhmucgame ON danhmucgame.id_danhmucgame = taikhoangame.id_danhmucgame WHERE donhang.id_nguoidung = ${id_nguoidung} ${maso} ${giatien} ${loctheongay} ORDER BY donhang.id_donhang DESC ${gioihan}";
        $sql = html_entity_decode($sql);
        // echo $sql;
        // die();
        return $this->selectCustom($sql);
    }
    public function getSoLuongDonHang($id_nguoidung)
    {
        $sql = "SELECT COUNT(*) FROM donhang WHERE  id_nguoidung=$id_nguoidung;";
        return $this->selectCustom($sql);
    }
    // LICHSUNAPTIEN
    public function lichSuNapTienAtm($id_nguoidung, $nganhang, $loctheongay)
    {
        $sql = "SELECT id_naptien,sotien,chietkhau,nganhang,ngaynaptien,noidung,trangthai FROM naptien WHERE id_nguoidung = $id_nguoidung AND loai = 'atm' $nganhang $loctheongay";
        $sql = html_entity_decode($sql);

        return $this->selectCustom($sql);
    }
    public function lichSuNapTienCard($id_nguoidung)
    {
        $sql = "SELECT id_naptien,sotien,chietkhau,nhamang,ngaynaptien,mathe,seri,trangthai FROM naptien WHERE id_nguoidung = $id_nguoidung AND loai = 'card'";

        $sql = html_entity_decode($sql);

        return $this->selectCustom($sql);
    }
    public function updateNaptien($id_nguoidung, $sotiennap)

    {
        $sql = "UPDATE nguoidung SET sodu=sodu + $sotiennap,tongtiendanap=tongtiendanap + $sotiennap WHERE id_nguoidung=$id_nguoidung";
        return $this->updateCustom($sql);
    }

    //ADMIN
    public function nguoidangkimoi()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay_hom_nay = date('Y-m-d');
        $sql = "SELECT id_nguoidung FROM nguoidung WHERE DATE(ngaydangki) = '$ngay_hom_nay'";
        return $this->selectCustom($sql);

    }
    public function hienThiNguoiDung($gioihan = "", $where =""){
        $sql = "SELECT * FROM nguoidung WHERE capbac = 'nguoidung'
        $where
        $gioihan
        ";
        return $this->selectCustom($sql);
    }
}
