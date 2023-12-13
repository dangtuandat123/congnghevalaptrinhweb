
<?php
class AdminModel extends BaseModel
{
    const TABLE = 'game';
    public function getAll()
    {
        return $this->selectAll(self::TABLE);
    }
    public function findById($id)
    {
        return 1;
    }

    public function doanhThuThangNay($ngay)
    {
        $sql = "SELECT SUM(giatien) FROM hoadon WHERE DATE(thoigianhethan) = '$ngay' AND tinhtrang = 'Thành công'";
        return $this->selectCustom($sql);
    }
    public function selectCustoms($sql)
    {

        return $this->selectCustom($sql);
    }
    public function tatCaCaiDat()
    {
        return $this->selectAll("caidat");
    }
    public function capNhapCaiDat($tentrangweb, $thongbao, $anhbia, $logo)
    {
        return $this->update("caidat", [
            'tentrangweb' => $tentrangweb,
            'thongbao' => $thongbao,
            'anhbia' => $anhbia,
            'logo' => $logo,
        ], [
            'id' => 1,
        ]);
    }
    public function capNhapPlugin($plugin)
    {
        return $this->update("caidat", [
            'plugin_chat' => $plugin,

        ], [
            'id' => 1,
        ]);
    }
    public function capNhapVnpay($terminal_id, $secret_key)
    {
        return $this->update("vnpay", [
            'terminal_id' => $terminal_id,
            'secret_key' => $secret_key,

        ], [
            'id' => 1,
        ]);
    }
    public function capNhapMomo($partnercode, $accesskey, $secretkey)
    {
        return $this->update("momo", [
            'partnercode' => $partnercode,
            'accesskey' => $accesskey,
            'secretkey' => $secretkey,


        ], [
            'id' => 1,
        ]);
    }
    public function capNhapTrangthai($trangthai)
    {
        return $this->update("caidat", [
            'trangthai' => $trangthai,


        ], [
            'id' => 1,
        ]);
    }
    public function capNhapLienHe($lienhe)
    {
        return $this->update("caidat", [
            'lienhe' => $lienhe,

        ], [
            'id' => 1,
        ]);
    }
    public function caiDatVnpay()
    {
        return $this->selectAll("vnpay");
    }
    public function caidatmomo()
    {
        return $this->selectAll("momo");
    }



    // thongke


    public function thongKeDoanhThu($ngay)
    {
        $sql = "SELECT SUM(giatien) FROM hoadon WHERE DATE(thoigianhethan) = '$ngay' AND tinhtrang = 'Thành công'";
        return $this->selectCustom($sql);
    }
    public function thongKeDoanhThu_TheoNam($nam)
    {
        $sql = "SELECT SUM(giatien) 
        FROM hoadon 
        WHERE CONCAT(YEAR(thoigianhethan), '-', LPAD(MONTH(thoigianhethan), 2, '0')) = '$nam' 
              AND tinhtrang = 'Thành công';";
        return $this->selectCustom($sql);
    }
    public function thongKeDonHang($ngay)
    {
        $sql = "SELECT COUNT(*) FROM donhang WHERE DATE(thoigianmua) = '$ngay'";
        return $this->selectCustom($sql);
    }
    public function thongKeDonHang_TheoNam($nam)
    {
        $sql = "SELECT COUNT(*) 
        FROM donhang 
        WHERE CONCAT(YEAR(thoigianmua), '-', LPAD(MONTH(thoigianmua), 2, '0')) = '$nam'";
        return $this->selectCustom($sql);
    }
    public function tongDoanhthu()
    {
        $sql = "SELECT SUM(giatien) FROM hoadon WHERE tinhtrang = 'Thành công'";
        return $this->selectCustom($sql);
    }
    public function tongDonHang()
    {
        $sql = "SELECT COUNT(*) FROM donhang";
        return $this->selectCustom($sql);
    }
}
